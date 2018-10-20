<?php

namespace App\OAuthProviders;

class Provider
{
    public function driver($driver)
    {
        $className = 'App\OAuthProviders\\' . ucfirst($driver) . 'Provider';

        return new $className;
    }
}
