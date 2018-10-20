<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        \App\Account::forceCreate([
            'user_id' => '1',
            'provider' => 'Mercari',
            'email' => 'hashmail',
            'access_token' => 'token',
            'refresh_token' => 'token',
        ]);

        \App\Account::forceCreate([
            'user_id' => '1',
            'provider' => 'Allegro',
            'email' => 'hashmail2',
            'access_token' => 'token2',
            'refresh_token' => 'token2',
        ]);

        \App\User::forceCreate([
            'id' => '1',
        ]);

        \App\Email::forceCreate([
            'user_id' => '1',
            'email' => 'hashmail',
        ]);

        \App\Email::forceCreate([
            'user_id' => '1',
            'email' => 'hashmail2',
        ]);

        \App\Review::forceCreate([
            'rating' => '4.4',
            'account_id' => '1',
            'type' => 'created',
        ]);

        \App\Review::forceCreate([
            'rating' => '4.9',
            'account_id' => '1',
            'body' => 'great seller!!!',
            'type' => 'created',
        ]);

        \App\Review::forceCreate([
            'rating' => '4.6',
            'account_id' => '2',
            'type' => 'created',
        ]);

        \App\Customer::forceCreate([
            'name' => 'Mercari',
            'api_token' => 'token',
        ]);

        \App\Customer::forceCreate([
            'name' => 'Allegro',
            'api_token' => 'token2',
        ]);
    }
}
