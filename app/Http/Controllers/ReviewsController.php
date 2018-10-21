<?php

namespace App\Http\Controllers;

use App\Email;
use App\Review;
use App\Account;
use Illuminate\Http\Request;
use Facades\App\OAuthProviders\Provider;

class ReviewsController extends Controller
{
    public function fetch()
    {
        Account::all()->each(function ($account) {
            Provider::driver($account->provider)->fetchReviews($account);
        });
    }

    public function sendReviews(Request $request, $customer, $email)
    {
        // check if user is correct
        //print(auth()->user()->name."\n");
        if ($customer === auth()->user()->name) {
            $user_id = Email::where('email', $email)->first()->user_id;
            $accounts = Account::where('user_id', $user_id)->where('provider', '!=', $customer)->get();
            // print($user_id."\n");
            $reviews = [];
            foreach($accounts as $account) {
                $reviews[$account->provider] = Review::where('account_id', $account->id)->get();
            }
            return $reviews;
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

}
