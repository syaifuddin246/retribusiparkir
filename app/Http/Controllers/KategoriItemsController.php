<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use Illuminate\Http\Request;

class KategoriItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = KategoriItem::all();
        return view('admin.content.items.kategori.index',compact('data'));
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
        $request->validate([
            'items' => 'required',
            'price' => 'required',
        ]);

        KategoriItem::create([
            'items' => $request->items,
            'price' => $request->price,
        ]);
        return redirect('admin/kategori_items')->with('message','Data Berhasil Ditambahkan');
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
        $data = KategoriItem::find($id);
        return view('admin.content.items.kategori.edit',compact('data'));
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
        $request->validate([
            'items' => 'required',
            'price' => 'required',
        ]);
        $data = KategoriItem::find($id);
        $data->update([
            'items' => $request->items,
            'price' => $request->price,
        ]);
        return redirect('admin/kategori_items')->with('message','Data Berhasil Diperbarui');
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
        $data = KategoriItem::find($id);
        $data->delete();
        return redirect('admin/kategori_items')->with('message','Data Berhasil Dihapus');
    }

    public function getapi($id){
        $dt = KategoriItem::find($id);

        return response()->json([
            'data'=>$dt
        ]);
    }
}
