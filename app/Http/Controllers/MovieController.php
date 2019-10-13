<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Scrapper;
use App\Genre;
use App\PersonActsMovie;
use App\PersonDirectsMovie;
use App\GenreMovie;

class MovieController extends Controller
{
	private $baseDir = "/app/public/movies/Películas/";	// Default location to scan movies if no other is provided

    /**
     * Create a new controller instance.
     * Login es needed except for list, show and play movie, and scan (scrap) a single movie.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'list', 'show', 'play', 'scanSingle', 'search');
    }
    	
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
		$data['movies'] = Movie::getAll();
		$data['genres'] = Genre::getMorePopular();
		return view('movieList', $data);
	}
	
    /**
     * Show a specific movie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function show($id, $infoText = null) {
		$data['movie'] = Movie::find($id);
		$data['directors'] = Movie::findDirectors($id);
		$data['actors'] = Movie::findActors($id);
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
        Movie::create($request->all());
        return redirect()->action('Movie@show', ['id' => $id, 'infoText' => "Registro creado correctamente"]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $movie = Movie::find($id);
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
 
        Movie::find($id)->update($request->all());
        return redirect()->action('Movie@show', ['id' => $id, 'infoText' => "Registro modificado con éxito"]);
 
    }
 
    /**
     * Remove the specified movie from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Movie::find($id)->delete();
        PersonActMovie::where('idMovie', $id)->delete();
        PersonDirectMovie::where('idMovie', $id)->delete();
        GenreMovie::where('idMovie', $id)->delete();
		$data['infoText'] = "Película borrada con éxito";
		$data['movies'] = Movie::getAll();
		return redirect()->action('Movie@list')->with(['infoText' => "Película borrada con éxito"]);
    }
 	
	/**
	 * Plays movie through external application
	 * TODO: stream video from vlc server (for now, file is downloaded by browser; you can configure your browser for locally open it with vlc)
	 * 
	 * @param int $id Movie id
	 */ 
	public function play($id) {
		$movie = Movie::find($id);
		// WARNING: TODO: this fix is a shabby patch because the path is wrongly saved on BD
		$pos = strpos($movie->fileDirName, "/movies");
		$data['movieFile'] = substr($movie->fileDirName, $pos)."/".$movie->fileName;
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
		$data['movies'] = Movie::search($searchString);
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
		$moviesFound = Movie::scan($location);
		$moviesFileNames = Movie::getFileNamesFromFullPath($moviesFound);
		$moviesDirNames = Movie::getDirNamesFromFullPath($moviesFound);
		$moviesTitles = Movie::getMoviesTitlesFromFileNames($moviesFileNames);
		
		$moviesCount = Movie::createAndSave($moviesFileNames, $moviesDirNames, $moviesTitles, $this->baseDir);
		
		$data['movies'] = Movie::getAll();
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
		$movie = Movie::find($id);
		$movie->scrapMovie($this->baseDir, $url);
		$movie->save();
		
		$data['movie'] = Movie::find($id);
		$data['directors'] = Movie::findDirectors($id);
		$data['actors'] = Movie::findActors($id);
		return view('movieShow', $data);
	}

	
}
