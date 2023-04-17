<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\cucian;
use App\Models\pelanggan;
use App\Models\pesanan;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class midtranscontrol extends Controller
{
    //
    public function postmidtrans(Request $request,$id)
    {
        $transaksi=pesanan::find($id);
        $pelanggan=User::find($transaksi->id_pelanggan);
        $user=pelanggan::where('id_user',$pelanggan->id)->get();
        \Midtrans\Config::$serverKey = 'SB-Mid-server-nkf7HA_OBZv5PVudZKEKOXUJ';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $validator = Validator::make($request->all(), [
            'uang' => 'required',
            'nama_awal' => 'required',
            'nama_akhir' => 'required|min:8',
            'email' => 'required|email|unique:users ',
            'phone' => 'required',
        ]);

        foreach($user as $u){
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $transaksi->total_biaya,
                ),
                'customer_details' => array(
                    'first_name' => $pelanggan->name,
                    'last_name' => $pelanggan->name,
                    'email' => $pelanggan->email,
                    'phone' => $u->nomor_telepon,
                ),
            );
        }
        cucian::create([
            'id_request'=>$transaksi->id_request,
            'status'=>'dalam proses antrian'
        ]);

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json([
            'status'=>'sukses',
            'data'=>$snapToken
        ]);
    }
}
