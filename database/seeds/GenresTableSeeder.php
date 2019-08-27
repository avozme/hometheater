<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'name' => 'Drama'
        ]);

        DB::table('genres')->insert([
            'name' => 'Comedia'
        ]);

        DB::table('genres')->insert([
            'name' => 'Terror'
        ]);

        DB::table('genres')->insert([
            'name' => 'Fantástico'
        ]);
        
        DB::table('genres')->insert([
            'name' => 'Boxeo'
        ]);
        

    }
}
