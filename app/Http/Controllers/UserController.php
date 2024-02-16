<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data User',
            'data_user' => User::all(),
        );
        // return view('index',$data); 
        return view('admin.master.user.list', $data);
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/user')->with('success', 'Data berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        User::where('id', $id)
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => hash::make($request->password),
                'role' => $request->role,
            ]);

        return redirect('/user')->with('success', 'Data berhasil Di ubah');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return redirect('/user')->with('success', 'Data Berhasil Dihapus');
    }
}
