<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    use ApiResponses;

    //
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->error('Invalid credentials', 401, []);
        }

        $user = Auth::user();

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken('API token for ' . $user->email, ['*'], now()->addMonth())->plainTextToken
            ]
        );
    }

    public function register()
    {
        return $this->ok('Register');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('logout successful');
    }
}
