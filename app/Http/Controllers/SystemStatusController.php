<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemStatusController extends Controller
{
    public function __invoke()
    {
        return [
            'online' => true,
            'version' => config('app.version'),
        ];
    }
}
