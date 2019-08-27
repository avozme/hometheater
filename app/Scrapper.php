<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movies;

class Scrapper extends Model
{
	private $resp, $movieUrl, $movieTitle, $movieDirectory, $baseDir, $logfile;
	
	// Launch a GET request on filmaffinity.com/es (through advanced search)
	// and save response on $this->resp for further processing
	public function launchGetRequest($movieTitle, $movieDirectory, $baseDir) {
		// Initialize logfile for debug
		$this->logfile = "log_".date("Y-m-d").".log";
		
		// Launch search on filmaffinity
		$this->movieTitle = $movieTitle;	// Save movieTitle without url encoding
		$this->movieDirectory = $movieDirectory;
		$this->baseDir = $baseDir;
		$movieTitle = urlencode($this->movieTitle);	// We'll use title with url encoding only for curl request
		file_put_contents($this->logfile, "\n\nLaunching get request for movie: $movieTitle\n", FILE_APPEND);
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'https://www.filmaffinity.com/es/advsearch.php?stext='.$movieTitle.'&stype[]=title&country=&genre=&fromyear=&toyear=&orderby=relevance',
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		]);
		$initialResp = curl_exec($curl);
		curl_close($curl);

		// Search on response for the movie URL
		$pos = strpos($initialResp, 'mc-poster');	// First, we found the 'mc-poster' class id
		$initialResp = substr($initialResp, $pos);

		
		$pos = strpos($initialResp, "href") + 6;	// Inside the 'mc-poster' there is an href to the movie page
		$initialResp = substr($initialResp, $pos);

		$pos = strpos($initialResp, "img") - 3;	// Past the href, there is a img tag. We use it to extract exactly the movie's URL
		$this->movieUrl = substr($initialResp, 0, $pos);



		// Load the movie page on filmaffinity.com
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'https://www.filmaffinity.com'.$this->movieUrl,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		]);
		$this->resp = curl_exec($curl);
		curl_close($curl);
	}
	
	// Retrieve movie general data (such cover, duration, year, etc) 
	// through scrapping the HTML code previously got.
	// Returns a movie with all those data.
    public function getMovieData() {

		$movie = new Movies();
		file_put_contents($this->logfile, "Movie URL: $this->movieUrl\n", FILE_APPEND);
		
		// Extract movie data from response
		// 1. Cover image URL
		$pos = strpos($this->resp, 'img itemprop="image"') + 51;
		$this->resp = substr($this->resp, $pos);
		$pos = strpos($this->resp, 'alt') - 1;
		$coverImgUrl = substr($this->resp, 0, $pos);
		file_put_contents($this->logfile, "Cover URL: $coverImgUrl\n", FILE_APPEND);
		
		// Copy image from URL to local
		$movie->cover = $this->movieTitle.".jpg";
		file_put_contents($this->logfile, "Cover path: $movie->cover\n", FILE_APPEND);
		$fullpath = "movies/covers/$movie->cover";
		$curl = curl_init ($coverImgUrl);
		$timeout = 5;
		curl_setopt($curl,CURLOPT_URL,$coverImgUrl);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,$timeout);
		curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		$rawdata = curl_exec($curl);
		curl_close($curl);
		if(file_exists($fullpath)){
			unlink($fullpath);
		}
		file_put_contents($fullpath, $rawdata);
		
		// 2. Rating
		$pos = strpos($this->resp, 'movie-rat-avg') + 47;
		$rating = substr($this->resp, $pos, 3);
		$movie->rating = round(floatval($rating));
		file_put_contents($this->logfile, "Rating: $rating\n", FILE_APPEND);
		
		// 3. Date
		$pos = strpos($this->resp, 'datePublished') + 15;
		$year = substr($this->resp, $pos, 4);
		$movie->year = intval($year);
		file_put_contents($this->logfile, "Year: $year\n", FILE_APPEND);
		
		// 4. Duration
		$pos = strpos($this->resp, 'duration') + 10;
		$duration = substr($this->resp, $pos, 3);
		$movie->duration = intval($duration);
		file_put_contents($this->logfile, "Duration: $duration\n", FILE_APPEND);
		
		return $movie;
	}
	
	// Retrieve directors list scrapping HTML data.
	// Returns an array with all directors names.
	public function getDirectors() {
		$pos = strpos($this->resp, '<dd class="directors">');
		$this->resp = substr($this->resp, $pos);
		$pos = strpos($this->resp, '<span itemprop="name">') + 22;
		$this->resp = substr($this->resp, $pos);
		$pos = strpos($this->resp, '</span>');
		$directors = array();
		$exit = false;
		file_put_contents($this->logfile, "Directors:\n", FILE_APPEND);
		$count = 0;
		while (!$exit) {
			$dirName = substr($this->resp, 0, $pos);
			$directors[] = $dirName;
			$count++;
			file_put_contents($this->logfile, "  * $dirName\n", FILE_APPEND);
			$pos = strpos($this->resp, '</a>') + 4;
			$this->resp = substr($this->resp, $pos);
			if ($this->resp[0] == ' ' || $count > 3) {	// This is the last name on directors list
				$exit = true;
			} else {	// There are more names on directors list
				$pos = strpos($this->resp, '<span itemprop="name">') + 22;
				$this->resp = substr($this->resp, $pos);
				$pos = strpos($this->resp, '</span>');
			}
		}
		return $directors;
	}
	
	// Retrieve actors and actress list scrapping HTML data.
	// Returns an array with all names.
	public function getCast() {
		$pos = strpos($this->resp, 'span itemprop="actor"');
		$this->resp = substr($this->resp, $pos);
		$pos = strpos($this->resp, '<span itemprop="name">') + 22;
		$this->resp = substr($this->resp, $pos);
		$pos = strpos($this->resp, '</span>');
		$actors = array();
		$exit = false;
		file_put_contents($this->logfile, "Cast:\n", FILE_APPEND);
		$count = 0;
		while (!$exit) {
			$actName = substr($this->resp, 0, $pos);
			$actors[] = $actName;
			$count++;
			file_put_contents($this->logfile, "  * $actName\n", FILE_APPEND);
			$pos = strpos($this->resp, '</a>') + 4;
			$this->resp = substr($this->resp, $pos);
			if ($this->resp[0] == ' ' || $count > 10) {	// This is the last name on cast list
				$exit = true;
			} else {	// There are more names on cast list
				$pos = strpos($this->resp, '<span itemprop="name">') + 22;
				$this->resp = substr($this->resp, $pos);
				$pos = strpos($this->resp, '</span>');
			}
		}
		return $actors;
	}
	
	
	// Retrieve genres list scrapping HTML data.
	// Returns an array with all genre names.
	public function getGenres() {
		$pos = strpos($this->resp, '<span itemprop="genre">') + 110;
		$this->resp = substr($this->resp, $pos);
		$pos = strpos($this->resp, "</a>");
		$genres = array();
		$exit = false;
		file_put_contents($this->logfile, "Genres:\n", FILE_APPEND);
		$count = 0;
		while (!$exit) {
			$genName = substr($this->resp, 0, $pos);
			$genName = preg_replace("/[^a-zA-Z0-9áéíóúñAÉÍÓÚÑ\s]/", "", $genName);	// Sometimes, genre name isn't recovered clean: we apply a creaning routine to string
			$genres[] = $genName;
			$count++;
			file_put_contents($this->logfile, "  * $genName\n", FILE_APPEND);
			$pos = strpos($this->resp, "</span>") + 7;
			$this->resp = substr($this->resp, $pos);
			if ($this->resp[0] == ' ' || $count > 6) {	// This is the last genre on genres list
				$exit = true;
			} else {	// There are more genres on list
				$pos = strpos($this->resp, '<span itemprop="genre">') + 110;
				$this->resp = substr($this->resp, $pos);
				$pos = strpos($this->resp, '</a>');
			}
		}
		// Add directory names as genres
		$movieDirectory = $this->movieDirectory;
		$movieDirectory = substr($movieDirectory, strlen($this->baseDir));	// Substract baseDir from movie directory (we only have interested o "true" movie directories)
		if ($movieDirectory[0] == '/') $movieDirectory = substr($movieDirectory, 1);	// Remove first slash (if any)
		if ($movieDirectory[strlen($movieDirectory)-1] == '/') $movieDirectory = substr($movieDirectory, 0, strlen($movieDirectory)-1);		// Remove last slash (if any)
		$directories = explode("/", $movieDirectory);
		foreach ($directories as $dir) {
			$genres[] = $dir;
		}
		
	return $genres;
	}
				
}
