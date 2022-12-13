<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriItem;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //

    public function index(){
        $kategori = KategoriItem::all();

        return response()->json([
            'message' => 'success',
            'data' => $kategori
        ],200);
        // dd('data kategori');
    }
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
    public function show($id){
        $kategori = KategoriItem::find($id);
        
        return response()->json([
            'message' => 'success',
            'data' => $kategori,
        ],200);
    }
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

    public function destroy($id){
        $kategori = KategoriItem::find($id);
        $kategori->delete();

        return response()->json([
            'message' => 'success'
        ],200);
    }


}
