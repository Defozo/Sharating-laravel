<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Facades\App\OAuthProviders\Provider;

class LoginController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request, $provider)
    {
        if (!in_array($provider, array_keys(config('services.oauth')))) {
            return abort(404, 'Given provider is not available.');
        }

        $result = Provider::driver($provider)->getResult($request->code);
        $hashedId = $result['hashedId'];
        $accessToken = $result['accessToken'];
        $refreshToken = $result['refreshToken'];

        $hash = Hash::get('hash', $hashedId)->first();

        if ($hash === null) {
            $user = User::create();

            Hash::create([
                'user_id' => $user->id,
                'hash' => $hashedId,
            ]);

            Account::forceCreate([
                'user_id' => $user->id,
                'provider' => $provider,
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
            ]);

            return [
                'user_id' => $user->id,
                'authorized_providers' => [$provider],
            ];
        }

        return [
            'user_id' => $hash->user_id,
            'authorized_providers' => Account::where('user_id', $hash->user_id)->get()->map(function ($account) {
                return $account['provider'];
            })->unique()->toArray(),
        ];
    }
}
