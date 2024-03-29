<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Person;
use App\PersonDirectsMovie;
use App\PersonActsMovie;
use App\Genre;
use App\GenreMovie;
use App\Scrapper;

class Movie extends Model
{
    //
    protected $table = "movies";
    protected $primaryKey = "id";
    protected $fillable = array('id', 'title', 'year', 'duration', 'dateAdded', 'rating', 'cover', 'fileDirName', 'fileName', 'link');
    
    public function genres() {
		return $this->belongsToMany('App\Genre', 'genres_movies', 'idMovie', 'idGenre');
	}
	
	public function actors() {
		return $this->belongsToMany('App\Person', 'people_act_movies', 'idMovie', 'idPerson');
	}
	
	public function directors() {
		return $this->belongsToMany('app\Person', 'people_direct_movies', 'id_movie', 'id_person');
    }
    
    public static function getAll() {
		return DB::table('movies')->orderBy('year', 'desc')->orderBy('title', 'asc')->get();
	}
    
    public static function findDirectors($idMovie) {
		return DB::table('people')
					->join('people_direct_movies', 'people_direct_movies.idPerson', '=', 'people.id')
					->where('people_direct_movies.idMovie', '=', $idMovie)
					->select('people.*')
					->get();
	}

    public static function findActors($idMovie) {
		return DB::table('people')
					->join('people_act_movies', 'people_act_movies.idPerson', '=', 'people.id')
					->where('people_act_movies.idMovie', '=', $idMovie)
					->select('people.*')
					->get();
	}
	
	public static function search($searchString) {
		// Search by movie title
		$searchResultTitle = Movie::where('title', 'like', "%$searchString%")->orderBy('year', 'desc')->orderBy('title')->get();
		// Search by movie cast
		$searchResultCast = DB::table('movies')
								->join('people_act_movies', 'people_act_movies.idMovie', '=', 'movies.id')
								->join('people', 'people_act_movies.idPerson', '=', 'people.id')
								->select('movies.*')
								->where('people.name', 'like', "%$searchString%")->orderBy('year', 'desc')->orderBy('title')->get();
		// Search by movie direction
		$searchResultDirection = DB::table('movies')
								->join('people_direct_movies', 'people_direct_movies.idMovie', '=', 'movies.id')
								->join('people', 'people_direct_movies.idPerson', '=', 'people.id')
								->select('movies.*')
								->where('people.name', 'like', "%$searchString%")->orderBy('year', 'desc')->orderBy('title')->get();
		// Search by movie genre
		$searchResultGenre = DB::table('movies')
								->join('genres_movies', 'genres_movies.idMovie', '=', 'movies.id')
								->join('genres', 'genres_movies.idGenre', '=', 'genres.id')
								->select('movies.*')
								->where('genres.name', 'like', "%$searchString%")->orderBy('year', 'desc')->orderBy('title')->get();
		
		// Merging and returning all results
		$searchResult = $searchResultTitle->toBase()->merge($searchResultCast->toBase())->merge($searchResultDirection->toBase())->merge($searchResultGenre->toBase());
		return $searchResult;
	}
	
	public static function scan($dir) {
		$moviesFound = array();
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if ($file == '.' || $file == '..') {
						// Ignore . and .. directories
						continue;
					}
					if (is_dir($dir.$file)) {
						// Subdirectory found: launch recursive scan and add results to $moviesFound
						$otherMoviesFound = Movie::scan($dir.$file.'/');
						foreach ($otherMoviesFound as $movie) {
							$moviesFound[] = $movie;
						}
					} else {
						// File found: add to $moviesFound if extension fits
						$ext = substr($file, strlen($file)-3, 3);
						if ($ext=='avi' || $ext=='mpg' || $ext=='mkv' || $ext=='wmv' || $ext=='rpm' || $ext=='mp4' || $ext=='m4v') {
							$moviesFound[] = $dir . $file;
						}
					}
				}
				closedir($dh);
			}
		} 
		return $moviesFound;
	}
	
	public static function getFileNamesFromFullPath($moviesFound) {
		$fileNames = array();
		foreach ($moviesFound as $movie) {
			$tokens = explode("/", $movie);
			$fileNames[] = $tokens[count($tokens)-1];
		}
		return $fileNames;
	}
	
	public static function getDirNamesFromFullPath($moviesFound) {
		$dirNames = array();
		foreach ($moviesFound as $movie) {
			$lastSlashPos = strrpos($movie, "/");
			$dirNames[] = substr($movie, 0, $lastSlashPos);
		}
		return $dirNames;
	}
	
	public static function getMoviesTitlesFromFileNames($moviesFileNames) {
		$movieTitles = array();
		foreach ($moviesFileNames as $movieFileName) {
			$exit = false;
			$i = 0;
			while (!$exit) {
				if (($movieFileName[$i] >= '0' && $movieFileName[$i] <= '9') || ($movieFileName[$i] == ' ') || ($movieFileName[$i] == '-'))
					$i++;
				else
					$exit = true;
			}
			$movieTitles[] = substr($movieFileName, $i, strlen($movieFileName) - 4 - $i);
		}
		return $movieTitles;		
	}
	
	public static function createAndSave($moviesFileNames, $moviesDirNames, $moviesTitles, $baseDir) {
		$moviesCount['processed'] = 0;	// Counts all movies found and processed
		$moviesCount['inserted'] = 0;	// Counts how many movies are really inserted on DB (only the new ones)
		$moviesCount['moved'] = 0;		// Counts how many movies has been moved from their previous locations
		
		for ($i = 0; $i < count($moviesTitles); $i++) {
			$moviesCount['processed']++;
			$movieTitle = $moviesTitles[$i];
			$searchResult = Movie::where('title', '=', $movieTitle)->get();
			if (count($searchResult) == 0) {
				// The movie title doesn't exist on DB: we gonna create and save it
				$moviesCount['inserted']++;
				$movie = new Movie();
				// We know yet some data
				$movie->title = $moviesTitles[$i];
				$movie->fileDirName = $moviesDirNames[$i];
				$movie->fileName = $moviesFileNames[$i];
				$movie->save();
				// We recover the rest of data from web scrapping
				$movie->scrapMovie($baseDir);
				// Sleep for 1 second in order to not overload server (in that case, server may reject our queries)
				sleep(1);
				// Finally, we save data scrapped on DB
				$movie->save();
			} else {
				// The movie existed yet on DB. Perhaps file location has been changed?
				$movie = $searchResult[0];
				$movie->fileDirName = $moviesDirNames[$i];
				$movie->fileName = $moviesFileNames[$i];
				if ($movie->save()) {		// We try to update record with new dir and filename; if nothing has changed, nothing will happend on DB
					$moviesCount['moved']++;
				}
			}
		}
		return $moviesCount;
	}
	
	public function scrapMovie($baseDir, $movieUrl = null) {
		// Launch scrapper
		$scrapper = new Scrapper($this->title, $this->fileDirName, $baseDir);
		if ($movieUrl == null) $movieUrl = $scrapper->launchWebSearch();
		$scrapper->retrieveMovieInfoFromWeb($movieUrl);
		$this->retrieveInfoFromScrapper($scrapper);
	}
	
	private function retrieveInfoFromScrapper($scrapper) {
		// Retrieve general data
		$movieData = $scrapper->getMovieData();
		$this->year = $movieData->year;
		$this->duration = $movieData->duration;
		$this->rating = $movieData->rating;
		$this->cover = $movieData->cover;
		$this->link = $movieData->link;
		$this->dateAdded = date("Y/m/d");
		$this->datePlayed = '2000/01/01';

		// Directing
		PersonDirectsMovie::where('idMovie', $this->id)->delete();
		$listDirectors = $scrapper->getDirectors();
		foreach ($listDirectors as $directorName) {
			$directorName = substr($directorName, 0, 500);
			$idPerson = 0;
			$personSearch = Person::where('name', '=', $directorName)->get();
			if (count($personSearch) == 0) {
				// This director doesn't exist on DB: we gonna add him/her
				$person = Person::create(['name' => $directorName, 'link' => 'https://imdb.com']); // TODO
				$idPerson = $person->id;
			} else {
				// The actor/actress existed yet on DB. Retrieving id.
				$idPerson = $personSearch[0]->id;
			}
			$personDirectMovie = PersonDirectsMovie::create(['idPerson' => $idPerson, 'idMovie' => $this->id]);
		}
		
		// Acting: retrieve actors' list from filmaffinity
		PersonActsMovie::where('idMovie', $this->id)->delete();
		$listActors = $scrapper->getCast();
		foreach ($listActors as $actorName) {
			$actorName = substr($actorName, 0, 500);
			$idPerson = 0;
			$personSearch = Person::where('name', '=', $actorName)->get();
			if (count($personSearch) == 0) {
				// This actor/actress doesn't exist on DB: we gonna add him/her
				$person = Person::create(['name' => $actorName, 'link' => 'https://imdb.com']); // TODO
				$idPerson = $person->id;
			} else {
				// The actor/actress existed yet on DB. Retrieving id.
				$idPerson = $personSearch[0]->id;
			}
			$personActsMovie = PersonActsMovie::create(['idPerson' => $idPerson, 'idMovie' => $this->id]);
		}

		// Genres
		GenreMovie::where('idMovie', $this->id)->delete();
		$listGenres = $scrapper->getGenres();
		foreach ($listGenres as $genre) {
			$genre = substr($genre, 0, 500);
			$genreSearch = Genre::where('name', '=', $genre)->get();
			$idGenre = 0;
			if (count($genreSearch) == 0) {
				// This actor/actress doesn't exist on DB: we gonna add him/her
				$newGenre = Genre::create(['name' => $genre]);
				$idGenre = $newGenre->id;
			} else {
				// The actor/actress existed yet on DB. Retrieving id.
				$idGenre = $genreSearch[0]->id;
			}
			$genreMovie = GenreMovie::create(['idGenre' => $idGenre, 'idMovie' => $this->id]);
		}

	}
	
}
