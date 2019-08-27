<?php

use Illuminate\Database\Seeder;

class PeopleActMoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people_act_movies')->insert([
            'idMovie' => 1,
            'idPerson' => 2
        ]);
        DB::table('people_act_movies')->insert([
            'idMovie' => 1,
            'idPerson' => 3
        ]);
        DB::table('people_act_movies')->insert([
            'idMovie' => 2,
            'idPerson' => 4
        ]);
        DB::table('people_act_movies')->insert([
            'idMovie' => 2,
            'idPerson' => 5
        ]);
        DB::table('people_act_movies')->insert([
            'idMovie' => 2,
            'idPerson' => 6
        ]);
        DB::table('people_act_movies')->insert([
            'idMovie' => 3,
            'idPerson' => 8
        ]);
        DB::table('people_act_movies')->insert([
            'idMovie' => 3,
            'idPerson' => 9
        ]);

    }
}
