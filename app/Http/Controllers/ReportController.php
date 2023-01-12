<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\ParkirIn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $kategori = KategoriItem::all();
        if (Auth::user()->level == 'master'){
            $data = ParkirIn::all();
        }else{
            // $data = ParkirIn::all()->where('user_id',Auth::user()->id);
            $data = ParkirIn::select('*')->where('user_id',Auth::user()->id)->get();
        }
        // if (request()->start_date || request()->end_date) {
        //     $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        //     $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
        //     if (Auth::user()->level == 'master'){
        //         $data = ParkirIn::whereBetween('updated_at',[$start_date,$end_date])->get();
        //     }else{
        //         $data = ParkirIn::whereBetween('updated_at',[$start_date,$end_date])->where('user_id',Auth::user()->id)->get();
        //     }
        // } else {
        //     if (Auth::user()->level == 'master'){
        //         $data = ParkirIn::all();
        //     }else{
        //         $data = ParkirIn::all()->where('user_id',Auth::user()->id);
        //     }
        // }
       
        
        return view('admin.content.items.report.index',compact('data'));
    }

    public function cetak_laporan(Request $request){
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;
        
        if ($tgl_mulai AND $tgl_selesai) {
            # code...
            if (Auth::user()->level == 'master'){
                $data = ParkirIn::select('*')->whereBetween('created_at',[$tgl_mulai." 00:00:00",$tgl_selesai." 23:59:59"])->get();
                $sum_total = ParkirIn::whereBetween('created_at',[$tgl_mulai." 00:00:00",$tgl_selesai." 23:59:59"])->sum('total');
               
            }else{
                $data = ParkirIn::select('*')->whereBetween('created_at',[$tgl_mulai." 00:00:00",$tgl_selesai." 23:59:59"])->where('user_id',Auth::user()->id)->get();
                $sum_total = ParkirIn::whereBetween('created_at',[$tgl_mulai." 00:00:00",$tgl_selesai." 23:59:59"])->where('user_id',Auth::user()->id)->sum('total');
            }
        } 
        return view('admin.content.items.report.laporan',compact('data','sum_total','tgl_mulai','tgl_selesai'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
