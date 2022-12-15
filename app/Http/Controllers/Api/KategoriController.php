<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriItem;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    /**
     * @OA\Get(
     *     path="/api/kategori",
     *     tags={"Kategori Kendaraan"},
     *     summary="Get (All Data Kendaraan)",
     *     operationId="findPetsByStatus",
     *     security={{"Bearer":{}}},
     *  @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="kategori",
     *         in="query",
     *         description="All Data",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available",},
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     * )
     */
    public function index(){
        $kategori = KategoriItem::all();

        return response()->json([
            'message' => 'success',
            'data' => $kategori
        ],200);
        // dd('data kategori');
    }
    // add data
    /**
     * @OA\Post(
     ** path="/api/kategori",
     *   tags={"Kategori Kendaraan"},
     *   summary="Store (Submit Data Kendaraan)",
     *   operationId="Add Data",
     *   security={{"Bearer":{}}},
     *  @OA\Parameter(
     *      name="items",
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
     *           type="number"
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
     *   )
     *)
     **/
    public function store(Request $request){
        $request->validate([
            'items' => 'required',
            'price' => 'required',
        ]);
        $kategori = KategoriItem::create([
            'items' => $request->items,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'success',
            'data' => $kategori
        ],200);
        // dd('cek');
    }

    // show
    /**
     * Get show data
     * @OA\Get (
     *   path="/api/kategori/{id}",
     *   tags={"Kategori Kendaraan"},
     *   summary="Show (Data Kendaraan)",
     *   operationId="Show Data",
     *   security={{"Bearer":{}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="content", type="string", example="content"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *         )
     *     )
     * )
     */
    public function show($id){
        $kategori = KategoriItem::find($id);
        
        return response()->json([
            'message' => 'success',
            'data' => $kategori,
        ],200);
    }

    // update
    //update data barang
     /**
     * Update 
     * @OA\Put (
     *   path="/api/kategori/{id}",
     *   tags={"Kategori Kendaraan"},
     *   summary="Update (Data Kendaraan)",
     *   operationId="Update Data",
     *     security={{"Bearer":{}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *  @OA\Parameter(
     *      name="items",
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
     *           type="number"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="content", type="string", example="content"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *          )
     *      )
     * )
     */

    public function update(Request $request,$id){
        $request->validate([
            'items' => 'required',
            'price' => 'required',
        ]);
        // dd('cek');
        $kategori = KategoriItem::find($id);
        $kategori->update([
            'items' => $request->items,
            'price' => $request->price,
        ]);
        return response()->json([
            'message' => 'success',
            'data' => $kategori
        ],200);
    }

     // delete
       /**
     * Delete Data
     * @OA\Delete (
     *      path="/api/kategori/{id}",
     *      tags={"Kategori Kendaraan"},
     *      summary="Delete (Data Kendaraan)",
     *      operationId="Delete Data",
     *      security={{"Bearer":{}}},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="delete todo success")
     *         )
     *     )
     * )
     */
    public function destroy($id){
        $kategori = KategoriItem::find($id);
        $kategori->delete();

        return response()->json([
            'message' => 'success'
        ],200);
    }


}
