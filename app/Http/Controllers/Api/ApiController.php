<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class ApiController extends Controller
{
   

    // metodo per prelevare il token

    public static function getToken() {
        return config('services.tl-api.token');
    }

    // metodo per prelelvare la root della api

    public static function getApiUri() {
        return config('services.tl-api.root');
    }

}
