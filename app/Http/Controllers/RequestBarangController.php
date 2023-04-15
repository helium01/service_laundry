<?php

namespace App\Http\Controllers;

use App\Models\RequestBarang;
use App\Models\User;
use Illuminate\Http\Request;
class RequestBarangController extends Controller
{
    public function index()
    {
        $request_barangs = RequestBarang::join('users','users.id','=','request_barangs.id_user')->select('users.name','request_barangs.*')->get();
        return response()->json([
            'status' => 'success',
            'data' => $request_barangs
        ]);
    }

    public function store(Request $request)
    {
        $request_barang = new RequestBarang();
        $request_barang->id_user = $request->input('id_user');
        $request_barang->status = $request->input('status');
        $request_barang->jenis_servis = $request->input('jenis_servis');
        $request_barang->jenis_paket = $request->input('jenis_paket');
        $request_barang->jumlah_barang = $request->input('jumlah_barang');
        $request_barang->save();

        return response()->json([
            'status' => 'success',
            'data' => $request_barang
        ]);
    }

    public function show($id)
    {
        $request_barang = RequestBarang::find($id);
        if ($request_barang) {
            return response()->json([
                'status' => 'success',
                'data' => $request_barang
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Request barang not found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request_barang = RequestBarang::find($id);
        if ($request_barang) {
            $request_barang->id_user = $request->input('id_user');
            $request_barang->status = $request->input('status');
            $request_barang->jenis_servis = $request->input('jenis_servis');
            $request_barang->jenis_paket = $request->input('jenis_paket');
            $request_barang->jumlah_barang = $request->input('jumlah_barang');
            $request_barang->save();

            return response()->json([
                'status' => 'success',
                'data' => $request_barang
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Request barang not found'
            ]);
        }
    }

    public function destroy($id)
    {
        $request_barang = RequestBarang::find($id);
        if ($request_barang) {
            $request_barang->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Request barang deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Request barang not found'
            ]);
        }
    }

}
