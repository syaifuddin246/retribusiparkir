<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\ParkirIn;
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
        

            // per user
            $namauser = User::orderBy('name','ASC')->get();
            // dd($namauser);
            $data2 = ParkirIn::select([
                DB::raw('CAST(SUM(price) as int) as total'),
                DB::raw('user_id as user'),
                DB::raw('MONTHNAME(created_at) as bulan'),
                DB::raw('EXTRACT(YEAR from created_at) as tahun'),
            ])
            ->whereYear('created_at', $th)
            ->groupBy(['user','bulan','tahun',])
            ->orderBy('created_at', 'ASC')
            ->pluck('total');
            // dd($data2);
        // total income per user
        // $total_income_users = ParkirIn::select([
        //     DB::raw('CAST(SUM(price) as int) as total_income_users'),
        // ])
        // ->whereYear('created_at', $th)
        // ->GroupBy(DB::raw("user_id"))
        // ->pluck('total_income_users');
        // dd($total_income_users);
        // return view('admin.dashboard');
        return view('admin.dashboard2',compact('namauser','data2','data','bulan','th','th_income','total_income'));
    }
}
