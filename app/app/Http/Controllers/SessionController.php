<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'ok' => false,
                'err' => 'ERR_INVALID_CREDS',
                'msg' => 'incorrect username or password',
            ], 401);
        }

        //Generate access token with custom lifetime
        $accessToken = Auth::user()->createToken('Access Token', [
            'scopes' => ['*'],
            'expires_in' => Carbon::now()->addSeconds(20),
        ])->plainTextToken;
        $refreshToken = Auth::user()->createToken('Refresh Token', [
            'scopes' => ['*'],
            'expires_in' => Carbon::now()->addDays(30),
        ])->plainTextToken;

        $user = Auth::user();

        return response()->json([
            'ok' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                ],
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
            ],
        ], 200);
    }

    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required',
        ]);

        $refreshToken = $request->input('refresh_token');
        Auth::user()->tokens()->where('name', 'Access Token')->delete();

        $newAccessToken = Auth::user()->createToken('Access Token')->plainTextToken;

        return response()->json([
            'ok' => true,
            'data' => [
                'access_token' => $newAccessToken,
            ],
        ]);
    }
}
