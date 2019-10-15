<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
        	[
        		'name'		=> 'alfredo',
        		'email'		=> 'alfredo@gmail.com',
        		'password'	=> bcrypt('1234'),
        		'created_at'=> Carbon::now(),
        		'updated_at'=> Carbon::now()
        	]
    	]);
    }
}
