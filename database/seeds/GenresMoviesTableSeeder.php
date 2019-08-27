<?php

use Illuminate\Database\Seeder;

class GenresMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('genres_movies')->insert([
            'idMovie' => 1,
            'idGenre' => 2
        ]);
        DB::table('genres_movies')->insert([
            'idMovie' => 1,
            'idGenre' => 4
        ]);
        DB::table('genres_movies')->insert([
            'idMovie' => 2,
            'idGenre' => 1
        ]);
        DB::table('genres_movies')->insert([
            'idMovie' => 2,
            'idGenre' => 5
        ]);
        DB::table('genres_movies')->insert([
            'idMovie' => 3,
            'idGenre' => 3
        ]);
        DB::table('genres_movies')->insert([
            'idMovie' => 3,
            'idGenre' => 4
        ]);

    }
}
