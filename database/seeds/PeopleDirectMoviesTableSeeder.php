<?php

use Illuminate\Database\Seeder;

class PeopleDirectMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('people_direct_movies')->insert([
            'idMovie' => 1,
            'idPerson' => 1
        ]);
        DB::table('people_direct_movies')->insert([
            'idMovie' => 2,
            'idPerson' => 4
        ]);
        DB::table('people_direct_movies')->insert([
            'idMovie' => 3,
            'idPerson' => 7
        ]);

    }
}
