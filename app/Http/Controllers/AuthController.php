<?php

namespace App\Http\Controllers;

use App\Services\Suppliers\SupplierLoginService;
use Illuminate\Http\Request;
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
