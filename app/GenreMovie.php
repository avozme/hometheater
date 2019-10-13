<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreMovie extends Model
{
    //
    protected $table = "genres_movies";
    protected $primaryKey = "id";
    protected $fillable = array('id', 'idGenre', 'idMovie');

}
