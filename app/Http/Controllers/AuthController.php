<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Pest\Laravel\json;

class AuthController extends Controller
{
    //
    public function login()
    {
        return response()->json([
            'message' => 'Hello, Login!'
        ]);
    }
}
