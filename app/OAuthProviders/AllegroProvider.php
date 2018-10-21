<?php

namespace App\OAuthProviders;

use App\Hash;
use App\User;
use Zttp\Zttp;

class AllegroProvider
{
    public function getUserInfoFromToken($token)
    {
        $tokenMiddlePart = explode('.', $token)[1];
        $payload = json_decode(base64_decode($tokenMiddlePart));
        return $payload;
    }

    public function fetchReviews()
    {
        // $response = Zttp::withHeaders([
        //     'Authorization' => 'Bearer ' . $account->access_token,
        //     'Accept' => 'application/vnd.allegro.public.v1+json',
        // ])->get(config('services.oauth.allegro.base_api_url') . '/sale/user-ratings?' . http_build_query([
        //     'user.id' => $this->getUserInfoFromToken($account->access_token)->user_name,
        // ]));

        // dd($response);
    }

    public function getResult($code)
    {
        $response = Zttp::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(config('services.oauth.allegro.client_id') . ':' . config('services.oauth.allegro.client_secret')),
        ])->post(config('services.oauth.allegro.base_url') . '/auth/oauth/token?' . http_build_query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => config('services.oauth.allegro.redirect'),
        ]));

        if (!$response->isSuccess()) {
            abort(500, 'Something went wrong with the provider.');
        }

        $data = $response->json();

        if (!isset($data['access_token']) || !isset($data['refresh_token'])) {
            abort(500, 'Something went wrong with the provider response.');
        }

        $payload = $this->getUserInfoFromToken($data['access_token']);

        return [
            'hashedId' => hash('sha3-512', $payload->user_name),
            'accessToken' => $data['access_token'],
            'refreshToken' => $data['refresh_token'],
        ];
    }
}
