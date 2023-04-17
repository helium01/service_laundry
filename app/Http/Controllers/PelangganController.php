<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return response()->json([
            'status'=>'sukses',
            'data'=>$pelanggan
        ]);
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return response()->json([
            'status'=>'sukses',
            'data'=>$pelanggan
        ]);
    }

    public function store(Request $request)
    {
        $user=User::find($request->id_user);
        $pelanggan = Pelanggan::create([
            'id_user'=>$request->id_user,
            'nama_pelanggan'=>$user->name,
            'alamat'=>$request->alamat,
            'nomor_telepon'=>$request->nomor_telepon
        ]);
        return response()->json([
            'status'=>'sukses',
            'data'=>$pelanggan
        ]);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());
        return response()->json($pelanggan, 200);
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return response()->json(null, 204);
    }
}
