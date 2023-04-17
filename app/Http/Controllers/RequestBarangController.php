<?php

namespace App\Http\Controllers;

use App\Models\kupon;
use App\Models\paketLaundry;
use App\Models\pesanan;
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
        if($request->jenis_servis == 'antar jemput') {
            $request_barang->latitude = $request->input('latitude');
            $request_barang->longitude = $request->input('longitude');
            
        }
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

    public function valid(Request $request,$id){
        $request_barang=RequestBarang::find($id);
        if($request_barang->status=='valid'){
            return response()->json([
                'status' => 'data sudah valid',
                'data' => $request_barang
            ]);
        }else{
            $request_barang->update(['status' => 'valid',
        'jumlah_barang'=>$request->jumlah_barang]);
            $request_barang = RequestBarang::find($id);
            $kode_kupon=kupon::where('kode_kupon',$request_barang->kode_kupon)->get();
            $paket_laundry=paketLaundry::find($request_barang->jenis_paket);
            if($kode_kupon->count()!=0) {
                foreach ($kode_kupon as $kupon) {
                    $nilai_kupon = $kupon->jumlah_diskon;
                    $nama_kupon=$kupon->kode_kupon;
                }

            }else{
                $nilai_kupon=0;
                $nama_kupon='tidak';
            }
            $pesanan=pesanan::create([
                'id_pelanggan'=>$request_barang->id_user,
                'tanggal_pesan'=>$request_barang->created_at,
                'jumlah_barang'=>$request_barang->jumlah_barang,
                'total_biaya'=>$request_barang->jumlah_barang*($paket_laundry->harga_paket-$nilai_kupon),
                'id_request'=>$request_barang->id,
                'status_pesanan'=>'pending',
                'pakai_kupon'=>$nama_kupon
            ]);
            $pesanan->save();
            return response()->json([
                'status' => 'success',
                'data' => $pesanan
            ]);
        }
        
    }

}
