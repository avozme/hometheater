<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
            'name' => 'Tim Burton',
            'link' => 'https://www.imdb.com/name/nm0000318/'
        ]);
        DB::table('people')->insert([
            'name' => 'Ewan McGregor',
            'link' => 'https://www.imdb.com/name/nm0000191/'
        ]);
        DB::table('people')->insert([
            'name' => 'Helena Bonham Carter',
            'link' => 'https://www.imdb.com/name/nm0000307/'
        ]);
        
        DB::table('people')->insert([
            'name' => 'Clint Eastwood',
            'link' => 'https://www.imdb.com/name/nm0000142/'
        ]);
        DB::table('people')->insert([
            'name' => 'Hilary Swank',
            'link' => 'https://www.imdb.com/name/nm0005476/'
        ]);
        DB::table('people')->insert([
            'name' => 'Morgan Freeman',
            'link' => 'https://www.imdb.com/name/nm0000151/'
        ]);


        DB::table('people')->insert([
            'name' => 'J. A. Bayona',
            'link' => 'https://www.imdb.com/name/nm1291105/'
        ]);
        DB::table('people')->insert([
            'name' => 'Belén Rueda',
            'link' => 'https://www.imdb.com/name/nm0749104/'
        ]);
        DB::table('people')->insert([
            'name' => 'Fernando Cayo',
            'link' => 'https://www.imdb.com/name/nm0147308/'
        ]);
    }
}
