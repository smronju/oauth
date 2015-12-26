<?php

use Illuminate\Database\Seeder;

class OauthClientEndpointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('oauth_client_endpoints')->truncate();

        DB::table('oauth_client_endpoints')->insert([
        	[
                'client_id' => 'testclient',
                'redirect_uri' => 'http://local.oauth.com/redirect'
            ],
            [
                'client_id' => 'client1',
                'redirect_uri' => 'http://local.oauth.com/client1'
            ],
            [
        		'client_id' => 'client2',
        		'redirect_uri' => 'http://local.oauth.com/client2'
        	]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
