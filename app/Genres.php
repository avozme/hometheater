<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Genres extends Model
{
    //
    protected $table = "genres";
    protected $primaryKey = "id";
    protected $fillable = array('id', 'name');
    
    public function movies() {
		return $this->belongsToMany('App\Movies', 'genres_movies', 'idGenre', 'idMovie');
	}
	
	public static function getMorePopular() {
		return DB::select( DB::raw('SELECT COUNT(genres.name) AS countGenre, genres.name FROM genres INNER JOIN genres_movies ON genres_movies.idGenre = genres.id GROUP BY genres.name ORDER BY countGenre DESC LIMIT 0,9'));
	}
}
