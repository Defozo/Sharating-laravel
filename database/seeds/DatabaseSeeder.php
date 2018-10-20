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
            'user_id' => 1,
            'provider' => 'Mercari',
            'access_token' => 'token',
            'refresh_token' => 'token',
        ]);

        \App\Account::forceCreate([
            'user_id' => 1,
            'provider' => 'Allegro',
            'access_token' => 'token2',
            'refresh_token' => 'token2',
        ]);

        \App\User::forceCreate([]);

        \App\Hash::forceCreate([
            'user_id' => 1,
            'hash' => 'hashmail',
        ]);

        \App\Hash::forceCreate([
            'user_id' => 1,
            'hash' => 'hashmail2',
        ]);

        \App\Review::forceCreate([
            'rating' => 4.4,
            'account_id' => 1,
            'type' => 'created',
        ]);

        \App\Review::forceCreate([
            'rating' => 4.9,
            'account_id' => 1,
            'body' => 'great seller!!!',
            'type' => 'created',
        ]);

        \App\Review::forceCreate([
            'rating' => 4.6,
            'account_id' => 2,
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
