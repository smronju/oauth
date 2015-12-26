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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('oauth_clients')->truncate();

        DB::table('oauth_clients')->insert([
        	[
                'id' => 'testclient',
                'secret' => 'secret',
                'name' => 'Test Client'
            ],
            [
                'id' => 'client1',
                'secret' => 'secret',
                'name' => 'Test Client 1'
            ],
            [
        		'id' => 'client2',
        		'secret' => 'secret',
        		'name' => 'Test Client 2'
        	]
    	]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
