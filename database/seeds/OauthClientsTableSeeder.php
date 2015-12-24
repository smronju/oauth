<?php

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
        	[
        		'id' => 'testclient',
        		'secret' => 'secret',
        		'name' => 'Test Client'
        	]
    	]);
    }
}
