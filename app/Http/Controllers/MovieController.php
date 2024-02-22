<?php

namespace App\Http\Controllers;

use App\Services\Suppliers\SupplierMovieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function getTitles(Request $request, SupplierMovieService $supplierMovieService): JsonResponse
    {
        try {
            return response()->json($supplierMovieService->execute());
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failure',
            ], 401);
        }
    }
}
