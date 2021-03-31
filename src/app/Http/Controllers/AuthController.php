<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        abort_unless(
            auth()->attempt(
                $request->only('email', 'password'),
                $request->has('remember')
            ),
            response([
                'message' => ['Unauthorized.']
            ], 401)
        );

        /**
         * Generate API token for access from third parties.
         * TODO: Identify third-party devices if possible.
         */
        // $token = auth()
        //     ->user()
        //     ->createToken('api')
        //     ->plainTextToken;

        return response(['authenticated'], 200);
    }

    public function logout(Request $request)
    {
        // https://github.com/laravel/sanctum/issues/87#issuecomment-691660791
        try {
            auth()->guard('web')->logout();
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(['logout']);
    }

    public function user(Request $request): UserResource
    {
        return new UserResource(auth()->user());
    }
}
