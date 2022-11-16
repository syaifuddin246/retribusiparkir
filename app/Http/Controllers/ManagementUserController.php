<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagementUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::all();
        return view('admin.content.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.content.users.add');
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
            'name' => 'required', 'string', 'max:255',
            'level' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('admin/users_management')->with(['message' => 'Data User Berhasil Dibuat']);
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
        $data = User::find($id);


        return view('admin.content.users.edit',compact('data'));
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
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        ]);

        User::whereId($id)->update([
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
        ]);

        return redirect('admin/users_management')->with(['message' => 'Data User Berhasil Diperbarui']);
        
    }
    public function updatepass(Request $request, $id)
    {
        //
        $request->validate([
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);
         

        User::whereId($id)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('admin/users_management')->with(['message' => 'Data Pass User Berhasil Diperbarui']);
        
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
        User::whereId($id)->delete();
        return redirect('admin/users_management')->with(['message' => 'Data User Berhasil Dihapus']);
    }
}
