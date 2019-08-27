<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleActMovies extends Model
{
    //
    protected $table = "people_act_movies";
    protected $primaryKey = "id";
    protected $fillable = array('id', 'idPerson', 'idMovie');

}
