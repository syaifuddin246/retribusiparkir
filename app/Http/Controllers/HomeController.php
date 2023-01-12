<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\ParkirIn;
use App\Models\ParkTembiring;
use App\Models\ParkKadilangu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if ($request->tahun) {
            $th = $request->tahun;
        } else {
            $th = date('Y');
        }
        // all data parkir
        $th_income = ParkirIn::select(DB::raw("Year(created_at) as thn"))
        ->groupBy(DB::raw("Year(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->get();

        $data = ParkirIn::select([
            DB::raw('CAST(SUM(price) as int) as total'),
            // DB::raw('user_id as user'),
            DB::raw('MONTHNAME(created_at) as bulan'),
            DB::raw('EXTRACT(YEAR from created_at) as tahun'),
        ])
        ->whereYear('created_at', $th)
        ->groupBy(['bulan','tahun',])
        ->orderBy('created_at', 'ASC')
        ->pluck('total');
        // dd($data);
        $total_income = ParkirIn::select([
            DB::raw('CAST(SUM(price) as int) as total_income'),
        ])
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("YEAR(created_at)"))
        ->pluck('total_income');
            // dd($total_income);
        $bulan = ParkirIn::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->pluck('bulan'); 
        // dd($bulan); 

        // end data all parkir in
        
        // tembiring
        $th_income = ParkTembiring::select(DB::raw("Year(created_at) as thn"))
        ->groupBy(DB::raw("Year(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->get();

        $data2 = ParkTembiring::select([
            DB::raw('CAST(SUM(price) as int) as total'),
            // DB::raw('user_id as user'),
            DB::raw('MONTHNAME(created_at) as bulan'),
            DB::raw('EXTRACT(YEAR from created_at) as tahun'),
        ])
        ->whereYear('created_at', $th)
        ->groupBy(['bulan','tahun',])
        ->orderBy('created_at', 'ASC')
        ->pluck('total');
        
        $total_income = ParkTembiring::select([
            DB::raw('CAST(SUM(price) as int) as total_income'),
        ])
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("YEAR(created_at)"))
        ->pluck('total_income');
           
        $bulan = ParkTembiring::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->pluck('bulan'); 
        
        // end tembiring
        
        // Kadilangu 
        $th_income = ParkKadilangu::select(DB::raw("Year(created_at) as thn"))
        ->groupBy(DB::raw("Year(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->get();

        $data3 = ParkKadilangu::select([
            DB::raw('CAST(SUM(price) as int) as total'),
            // DB::raw('user_id as user'),
            DB::raw('MONTHNAME(created_at) as bulan'),
            DB::raw('EXTRACT(YEAR from created_at) as tahun'),
        ])
        ->whereYear('created_at', $th)
        ->groupBy(['bulan','tahun',])
        ->orderBy('created_at', 'ASC')
        ->pluck('total');
        
        $total_income = ParkKadilangu::select([
            DB::raw('CAST(SUM(price) as int) as total_income'),
        ])
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("YEAR(created_at)"))
        ->pluck('total_income');
           
        $bulan = ParkKadilangu::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->whereYear('created_at', $th)
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->pluck('bulan'); 
        
        // end Kadilangu
        if(Auth::user()->level == 'master'){
            return view('admin.dashboard',compact('data3','data2','data','bulan','th','th_income','total_income'));
        }else{
            return redirect('admin/parkir_in/create');
        }
    }
}
