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
        DB::table('users')->truncate();

        DB::table('users')->insert([
        	[
        		'name' => 'Mohammad Shoriful Islam Ronju',
        		'email' => 'smronju@gmail.com',
        		'password' => bcrypt('c0mm0n')
        	],
        	[
        		'name' => 'Rinku Arnob',
        		'email' => 'rinku.arnob@gmail.com',
        		'password' => bcrypt('c0mm0n')
        	],
        	[
        		'name' => 'Md. Shahidul Haque Gazi',
        		'email' => 'gazi.cse@gmail.com',
        		'password' => bcrypt('c0mm0n')
        	],
        	[
        		'name' => 'Maruf Alam Evan',
        		'email' => 'maruf.evan@gmail.com',
        		'password' => bcrypt('c0mm0n')
        	]
        ]);
    }
}
