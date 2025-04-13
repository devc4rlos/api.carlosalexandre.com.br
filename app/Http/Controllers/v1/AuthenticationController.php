<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AuthenticationRequest;
use App\Http\Resources\v1\AuthenticationLoginResource;
use App\Http\Response\ResponseApi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(AuthenticationRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ResponseApi::builder("Invalid credentials. Please check your email and password.")
                ->setErrors(['message' => 'Invalid credentials.'])
                ->setCode(401)
                ->response();
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return ResponseApi::builder("Login successful.")
            ->setDataResource(AuthenticationLoginResource::make($token))
            ->response();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ResponseApi::builder("Logout successful. Token has been revoked.")->response();
    }
}
