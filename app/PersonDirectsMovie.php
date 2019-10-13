<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonDirectsMovie extends Model
{
    //
    protected $table = "people_direct_movies";
    protected $primaryKey = "id";
    protected $fillable = array('id', 'idPerson', 'idMovie');
    
}
