<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriItem;
use App\Models\ParkirIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkirController extends Controller
{
    //
    public function index(){
        if (Auth::user()->level == 'master'){
            $data = ParkirIn::with('kategori')->latest()->paginate(6);
        }else{
            $data = ParkirIn::with('kategori')->where('user_id',Auth::user()->id)->latest(6);
        }

        return response()->json([
            'message' => 'success',
            'data' => $data
        ],200);
        // dd('cek');
    }

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
