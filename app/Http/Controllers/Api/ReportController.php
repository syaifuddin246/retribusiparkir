<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkirIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
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
