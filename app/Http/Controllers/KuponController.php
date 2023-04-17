<?php

namespace App\Http\Controllers;

use App\Models\kupon;
use Illuminate\Http\Request;

class KuponController extends Controller
{
    public function index()
    {
        $kupons = Kupon::all();

        return response()->json([
            'success' => true,
            'data' => $kupons,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kupon' => 'required|string',
            'jenis_diskon' => 'required|string',
            'jumlah_diskon' => 'required|string',
        ]);

        $kupon = Kupon::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $kupon,
        ]);
    }

    public function show(Kupon $kupon)
    {
        return response()->json([
            'success' => true,
            'data' => $kupon,
        ]);
    }

    public function update(Request $request, Kupon $kupon)
    {
        $request->validate([
            'kode_kupon' => 'required|string',
            'jenis_diskon' => 'required|string',
            'jumlah_diskon' => 'required|string',
            'tanggal_kadaluarsa' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $kupon->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $kupon,
        ]);
    }

    public function destroy(Kupon $kupon)
    {
        $kupon->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
