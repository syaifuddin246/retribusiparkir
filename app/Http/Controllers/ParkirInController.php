<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\ParkirIn;
use App\Models\ParkTembiring;
use App\Models\ParkKadilangu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ParkirInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori = KategoriItem::all();
        if (Auth::user()->level == 'master'){
            $data = ParkirIn::select('*')->latest()->paginate(8);
        }
        if (Auth::user()->level == 'admintembiring'){
            $data = ParkTembiring::select('*')->where('user_id',Auth::user()->id)->latest()->paginate(8);
        }
        if (Auth::user()->level == 'adminkadilangu'){
            $data = ParkKadilangu::select('*')->where('user_id',Auth::user()->id)->latest()->paginate(8);
        }
        

        return view('admin.content.items.parkir_in.index',compact('kategori','data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori = KategoriItem::all();
        $data = ParkirIn::all();

        return view('admin.content.items.parkir_in.add',compact('kategori','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
        ]);
        // $img = $request->image;
        // $folderPath = "public/content/parkir_img/";
        
        // $image_parts = explode(";base64,", $img);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        
        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName =date('d-m-y').'_'. uniqid() . '.png';
        
        // $file = $folderPath . $fileName;
        // Storage::put($file, $image_base64);

        // dd('Image uploaded successfully: '.$fileName);

        // ParkirIn::create([
        //     'user_id' => Auth::user()->id,
        //     'kategori_item_id' => $request->kategori,
        //     'plat' => $request->plat,
        //     'status' => $request->status,
        //     'image' => $fileName,
        // ]);
        $data = ParkirIn::create([
            'user_id' => Auth::user()->id,
            'kategori_item_id' => $request->kategori,
            'plat' => $request->plat,
            'price' => $request->price,
            'price2' => $request->price2,
            'total' => $request->total,
            'status' => $request->status,
            'rombongan' => $request->rombongan,
            'porporasi' => $request->porporasi,
            // 'image' => $fileName,
        ])->id;
        if(Auth::user()->level == 'admintembiring'){
            $data = ParkTembiring::create([
                'user_id' => Auth::user()->id,
                'kategori_item_id' => $request->kategori,
                'plat' => $request->plat,
                'price' => $request->price,
                'price2' => $request->price2,
                'total' => $request->total,
                'status' => $request->status,
                'rombongan' => $request->rombongan,
                'porporasi' => $request->porporasi,
                // 'image' => $fileName,
            ])->id;
        }elseif(Auth::user()->level == 'adminkadilangu'){
            $data = ParkKadilangu::create([
                'user_id' => Auth::user()->id,
                'kategori_item_id' => $request->kategori,
                'plat' => $request->plat,
                'price' => $request->price,
                'price2' => $request->price2,
                'total' => $request->total,
                'status' => $request->status,
                'rombongan' => $request->rombongan,
                'porporasi' => $request->porporasi,
                // 'image' => $fileName,
            ])->id;
        }else{
            dd('notfound');
        }

        $id = $data;
        return redirect('/admin/parkir_in/'. $id);
        // return redirect('/admin/parkir_in')->with('message','Data Berhasil Disimpan');
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
        if (Auth::user()->level == 'master'){
            $data = ParkirIn::find($id);
        }elseif (Auth::user()->level == 'admintembiring'){
                $data = ParkTembiring::select('*')->whereId($id)->where('user_id',Auth::user()->id)->firstOrFail();
        }elseif(Auth::user()->level == 'adminkadilangu'){
                $data = ParkKadilangu::select('*')->whereId($id)->where('user_id',Auth::user()->id)->firstOrFail();
        }else{
            dd('notfound');
        }
        

        return view('admin.content.items.parkir_in.invoice',compact('data'));
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
    public function reqdelete()
    {
        //
        $kategori = KategoriItem::all();
        if (Auth::user()->level == 'master'){
            $data = ParkirIn::select('*')->latest()->paginate(8);
            $data2 = ParkTembiring::select('*')->latest()->paginate(8);
            $data3 = ParkKadilangu::select('*')->latest()->paginate(8);
        }

        return view('admin.content.items.reqdelete.index',compact('kategori','data','data2','data3'));
    }
    public function destroy($id)
    {
        //
        if($data = ParkirIn::find($id) != null){
            $data = ParkirIn::find($id);
            $data->delete();
        }elseif($data2 = ParkTembiring::find($id) != null){
            $data2 = ParkTembiring::find($id);
            $data2->delete();
        }elseif($data3 = ParkKadilangu::find($id) != null){
            $data3 = ParkKadilangu::find($id);
            $data3->delete();
        }else{
            dd('notfound');
        }

        return redirect('/admin/request_delete')->with('message','Data Berhasil Dihapus');
    }
   
}
