<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movies;
use App\Scrapper;
use App\Genres;
use App\PeopleActMovies;
use App\PeopleDirectMovies;
use App\GenresMovies;

class Movie extends Controller
{
	private $baseDir = "/app/public/movies/Películas/";	// Default location to scan movies if no other is provided
	
    /**
     * Show all movies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$this->list();
	}

   
    /**
     * Show all movies.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
		$data['movies'] = Movies::getAll();
		$data['genres'] = Genres::getMorePopular();
		return view('movieList', $data);
	}
	
    /**
     * Show a specific movie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function show($id, $infoText = null) {
		$data['movie'] = Movies::find($id);
		$data['directors'] = Movies::findDirectors($id);
		$data['actors'] = Movies::findActors($id);
		$data['infoText'] = $infoText;
		return view('movieShow', $data);
	}

	
	public function getBaseDir() { return $baseDir; }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('movieCreate');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request,[ 'title'=>'required', 'rating'=>'required', 'duration'=>'required', 'year'=>'required', 'link'=>'required']);
        Movies::create($request->all());
        return redirect()->action('Movie@show', ['id' => $id, 'infoText' => "Registro creado correctamente"]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $movie = Movies::find($id);
        return view('movieEdit',compact('movie'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {
        $this->validate($request,[ 'title'=>'required', 'rating'=>'required', 'duration'=>'required', 'year'=>'required', 'link'=>'required']);
 
        Movies::find($id)->update($request->all());
        return redirect()->action('Movie@show', ['id' => $id, 'infoText' => "Registro modificado con éxito"]);
 
    }
 
    /**
     * Remove the specified movie from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Movies::find($id)->delete();
        PeopleActMovies::where('idMovie', $id)->delete();
        PeopleDirectMovies::where('idMovie', $id)->delete();
        GenresMovies::where('idMovie', $id)->delete();
		$data['infoText'] = "Película borrada con éxito";
		$data['movies'] = Movies::getAll();
		return view('movieList', $data);
    }
 	
	/**
	 * Plays movie through external application
	 * TODO: stream video from vlc server (for now, file is downloaded by browser; you can configure your browser for locally open it with vlc)
	 * 
	 * @param int $id Movie id
	 */ 
	public function play($id) {
		$movie = Movies::find($id);
		// WARNING: TODO: this fix is a shabby patch because de path is  wrongly saved on BD
		$pos = strpos($movie->fileDirName, "/movies");
		$data['movieFile'] = substr($movie->fileDirName, $pos)."/".$movie->fileName;
		//passthru("vlc ".$movie->fileDirName."/".$movie->fileName, $response);
		//return view('moviePlay', $data);
		echo $data['movieFile'];
		return redirect($data['movieFile']);
	}
	
    /**
     * Show a list of movies as result as a search string.
     * The search can be made by movie title, cast names, directors names or genres.
     *
     * @param  String  $searchString
     * @return \Illuminate\Http\Response
     */
	public function search($searchString) {
		$data['movies'] = Movies::search($searchString);
		$data['infoText'] = "Resultados de la búsqueda: $searchString";
		return view('movieList', $data);
	}
	
    /**
     * Scan an specific location to find movies and add them to DB.
     * Some data are taken from movie file. Others are scrapped from filmaffinity.com.
     * Scrapping is managed on the model.
     * 
     * @param Request The form field with de base directory where the search will start
     *
     * @return \Illuminate\Http\Response
     */
	public function scanDir(Request $request) {
		$location = $request->input('baseDir');
		if ($location == null || $location == "") $location = $this->baseDir;
		$moviesFound = Movies::scan($location);
		$moviesFileNames = Movies::getFileNamesFromFullPath($moviesFound);
		$moviesDirNames = Movies::getDirNamesFromFullPath($moviesFound);
		$moviesTitles = Movies::getMoviesTitlesFromFileNames($moviesFileNames);
		
		$moviesCount = Movies::createAndSave($moviesFileNames, $moviesDirNames, $moviesTitles, $this->baseDir);
		
		$data['movies'] = Movies::getAll();
		$data['infoText'] = "El escaneo de nuevas películas ha finalizado. Se han encontrado ".$moviesCount['processed']." películas, de las cuales ".$moviesCount['inserted']." eran nuevas.";
		return view('movieList', $data);
	}

    /**
     * Scan an specific location to find movies and add them to DB.
     * Some data are taken from movie file. Others are scrapped from filmaffinity.com.
     * Scrapping is managed on the model.
     * 
     * @param Request The form field with de base directory where the search will start
     *
     * @return \Illuminate\Http\Response
     */
	public function scanSingle($id, Request $request) {
		$url = $request->input('movieUrlInput');
		$movie = Movies::find($id);
		$movie->scrapMovie($this->baseDir, $url);
		$movie->save();
		
		$data['movie'] = Movies::find($id);
		$data['directors'] = Movies::findDirectors($id);
		$data['actors'] = Movies::findActors($id);
		return view('movieShow', $data);
	}

	
}
