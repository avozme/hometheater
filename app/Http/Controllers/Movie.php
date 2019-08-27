<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movies;
use App\Scrapper;
use App\Genres;

class Movie extends Controller
{
	private $baseDir = "/app/public/movies/PELICULAS/";	// Default location to scan movies if no other is provided
	
    public function index() {
		$this->list();
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
        $this->validate($request,[ 'nombre'=>'required', 'resumen'=>'required', 'npagina'=>'required', 'edicion'=>'required', 'autor'=>'required', 'npagina'=>'required', 'precio'=>'required']);
        Libro::create($request->all());
        return redirect()->route('libro.index')->with('success','Registro creado satisfactoriamente');
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
        $this->validate($request,[ 'nombre'=>'required', 'resumen'=>'required', 'npagina'=>'required', 'edicion'=>'required', 'autor'=>'required', 'npagina'=>'required', 'precio'=>'required']);
 
        libro::find($id)->update($request->all());
        return redirect()->route('libro.index')->with('success','Registro actualizado satisfactoriamente');
 
    }
 
    /**
     * Remove the specified movie from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Movies::find($id)->delete();
		$data['infoText'] = "Película borrada con éxito";
		$data['movies'] = Movies::getAll();
		return view('movieList', $data);
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
	public function show($id) {
		$data['movie'] = Movies::find($id);
		$data['directors'] = Movies::findDirectors($id);
		$data['actors'] = Movies::findActors($id);
		return view('movieShow', $data);
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
	public function scan(Request $request) {
		$location = $request->input('baseDir');
		if ($location == null || $location == "") $location = $this->baseDir;
		$moviesFound = Movies::scan($location);
		$moviesFileNames = Movies::getFileNamesFromFullPath($moviesFound);
		$moviesDirNames = Movies::getDirNamesFromFullPath($moviesFound);
		$moviesTitles = Movies::getMoviesTitlesFromFileNames($moviesFileNames);
		
		$moviesCount = Movies::createAndSave($moviesFileNames, $moviesDirNames, $moviesTitles, $this->baseDir);
		
		$data['movies'] = Movies::getAll();
		$data['infoText'] = "El escaneo de nuevas películas ha finalizado. Se han encontrado ".count($moviesFound)." películas, de las cuales $moviesCount eran nuevas.";
		return view('movieList', $data);
	}
	
}
