<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $table = "people";
    protected $primaryKey = "id";
    protected $fillable = array('id', 'name', 'photo', 'link');
    
    public function actsInMovies() {
		return $this->belongsToMany('App\Movie', 'people_act_movies', 'idPerson', 'idMovie');
	}
	
	public function directsMovies() {
		return $this->belongsToMany('App\Movie', 'people_direct_movies', 'idPerson', 'idMovie');
	}
}
