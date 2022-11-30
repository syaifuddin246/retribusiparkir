<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\ParkirIn;
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
        }else{
            $data = ParkirIn::select('*')->where('user_id',Auth::user()->id)->latest()->paginate(8);
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

        return view('admin.content.items.parkir_in.add3',compact('kategori','data'));
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
        $img = $request->image;
        $folderPath = "public/content/parkir_img/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName =date('d-m-y').'_'. uniqid() . '.png';
        
        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

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
            'status' => $request->status,
            'image' => $fileName,
        ])->id;
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
        }else{
            $data = ParkirIn::select('*')->whereId($id)->where('user_id',Auth::user()->id)->firstOrFail();
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
    public function destroy($id)
    {
        //
    }
}
