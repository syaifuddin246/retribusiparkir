<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkirIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/laporan",
     *     tags={"Laporan"},
     *     summary="Get All Data Laporan",
     *     security={{"Bearer":{}}},
     *     @OA\RequestBody(
     *         description="List Data Parkir",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */
    public function index(){
        if (Auth::user()->level == 'master'){
            $data = ParkirIn::with('kategori')->latest()->paginate(6);
        }else{
            $data = ParkirIn::with('kategori')->where('user_id',Auth::user()->id)->latest()->paginate(6);
        }

        return response()->json([
            'message' => 'success',
            'data' => $data
        ],200);
    }
}
