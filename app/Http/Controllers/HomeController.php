<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\ParkirIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        // $kategori = KategoriItem::all();
        // $data = ParkirIn::select([
        //     DB::raw('sum(status) as jumlah'),
        //     DB::raw('EXTRACT(MONTH from created_at) as bulan'),
        //     DB::raw('EXTRACT(YEAR from created_at) as tahun'),
        // ])
        // // ->groupBy(['bulan','tahun'])->get()->toArray();
        // ->groupBy(['bulan','tahun',])->get();
        // // dd($data);
        if ($request->tahun) {
            $th = $request->tahun;
        } else {
            $th = date('Y');
        }
        $th_income = ParkirIn::select(DB::raw("Year(created_at) as thn"))
        ->groupBy(DB::raw("Year(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->get();

        $data = ParkirIn::select([
            DB::raw('CAST(SUM(price) as int) as total'),
            DB::raw('MONTHNAME(created_at) as bulan'),
            DB::raw('EXTRACT(YEAR from created_at) as tahun'),
        ])
        ->whereYear('created_at', $th)
        ->groupBy(['bulan','tahun',])
        ->orderBy('created_at', 'ASC')
        ->pluck('total');

        $total_income = ParkirIn::select([
            DB::raw('CAST(SUM(price) as int) as total_income'),
        ])
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("YEAR(created_at)"))
        ->pluck('total_income');
            
        $bulan = ParkirIn::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->pluck('bulan'); 

        // return view('admin.dashboard');
        return view('admin.dashboard2',compact('data','bulan','th','th_income','total_income'));
    }
}
