<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class midtranscontrol extends Controller
{
    //
    public function postmidtrans(Request $request)
    {
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


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->uang,
            ),
            'customer_details' => array(
                'first_name' => $request->nama_awal,
                'last_name' => $request->mana_akhir,
                'email' => $request->email,
                'phone' => $request->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response($snapToken);
    }
}
