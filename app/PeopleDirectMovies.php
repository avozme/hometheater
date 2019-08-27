<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleDirectMovies extends Model
{
    //
    protected $table = "people_direct_movies";
    protected $primaryKey = "id";
    protected $fillable = array('id', 'idPerson', 'idMovie');
    
}
