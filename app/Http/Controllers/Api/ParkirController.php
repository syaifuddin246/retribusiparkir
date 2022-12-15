<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriItem;
use App\Models\ParkirIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkirController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/parkir_in",
     *     tags={"Tiketin Parkir"},
     *     summary="Get All Data Parkir Masuk",
     *     security={{"Bearer":{}}},
     *     @OA\RequestBody(
     *         description="Data Parkir",
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
        // dd('cek');
    }

    // tambah data
     /**
     * @OA\Post(
     *     path="/api/parkir_in",
     *     tags={"Tiketin Parkir"},
     *     summary="Add Data Parkir",
     *     security={{"Bearer":{}}},
     *  @OA\Parameter(
     *      name="kategori",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="number"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="plat",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="rombongan",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="porporasi",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *)
     **/
    public function store(Request $request){
        
         $data = KategoriItem::all();
   
         $itemkat = $data->implode('id', ','); 
 
         $request->validate([
             'kategori' => 'required|in:'.$itemkat,
         ]);
 
         $post_data = ParkirIn::create([
            'user_id' => Auth::user()->id,
            'kategori_item_id' => $request->kategori,
            'plat' => $request->plat,
            'price' => $request->price,
            // 'status' => $request->status,
            'rombongan' => $request->rombongan,
            'porporasi' => $request->porporasi,
            // 'image' => $fileName,
         ]);
 
         return response()->json([
             'message' => 'success',
             'data' => $post_data,
         ],200);
        
        // dd('cek');
    }
}
