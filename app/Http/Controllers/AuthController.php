<?php

namespace App\Http\Controllers;

use App\Services\Suppliers\SupplierLoginService;
use App\Services\Suppliers\Suppliers\Baz\SupplierLogin;
use External\Bar\Auth\LoginService;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        $token = app(SupplierLoginService::class, ['login' => $request->get("login"), 'password' => $request->get("password")])->execute();
        return $token ?
            response()->json([
                'status' => 'success',
                'token' => $token
            ]) :
            response()->json([
                'status' => 'failure',
            ], 401);
    }
}
