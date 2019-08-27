<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('movies')->insert([
            'title' => 'Big Fish',
            'year' => 2003,
            'duration' => 126,
            'dateAdded' => '2015-09-03',
            'datePlayed' => '2015-09-10',
            'rating' => 8,
            'cover' => 'big-fish.jpg',
            'fileDirName' => 'movies/USA',
            'fileName' => '2003 - Big fish.avi',
            'link' => 'https://www.filmaffinity.com/es/film974553.html'
        ]);

        DB::table('movies')->insert([
            'title' => 'Million Dollar Baby',
            'year' => 2004,
            'duration' => 132,
            'dateAdded' => '2015-09-04',
            'datePlayed' => '2016-02-22',
            'rating' => 8,
            'cover' => 'million-dollar-baby.jpg',
            'fileDirName' => 'movies/USA',
            'fileName' => '2004 - Million Dollar Baby.avi',
            'link' => 'https://www.filmaffinity.com/es/film314359.html'
        ]);

        DB::table('movies')->insert([
            'title' => 'El orfanato',
            'year' => 2007,
            'duration' => 100,
            'dateAdded' => '2015-11-01',
            'datePlayed' => '2017-01-02',
            'rating' => 7,
            'cover' => 'el-orfanato.jpg',
            'fileDirName' => 'movies/Spain',
            'fileName' => '2007 - El orfanato.avi',
            'link' => 'https://www.filmaffinity.com/es/film245378.html'
        ]);

    }
}
