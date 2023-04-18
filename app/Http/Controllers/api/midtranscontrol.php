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
    public function server(){
// Set your server key (Note: Server key for sandbox and production mode are different)
$server_key = 'SB-Mid-server-nkf7HA_OBZv5PVudZKEKOXUJ';
// Set true for production, set false for sandbox
$is_production = false;

$api_url = $is_production ? 
  'https://app.midtrans.com/snap/v1/transactions' : 
  'https://app.sandbox.midtrans.com/snap/v1/transactions';


// Check if request doesn't contains `/charge` in the url/path, display 404
if( !strpos($_SERVER['REQUEST_URI'], '/charge') ) {
  http_response_code(404); 
  echo "wrong path, make sure it's `/charge`"; exit();
}
// Check if method is not HTTP POST, display 404
if( $_SERVER['REQUEST_METHOD'] !== 'POST'){
  http_response_code(404);
  echo "Page not found or wrong HTTP request method is used"; exit();
}

// get the HTTP POST body of the request
$request_body = file_get_contents('php://input');
// set response's content type as JSON
header('Content-Type: application/json');
// call charge API using request body passed by mobile SDK
$charge_result = chargeAPI($api_url, $server_key, $request_body);
// set the response http status code
http_response_code($charge_result['http_code']);
// then print out the response body
echo $charge_result['body'];

/**
 * call charge API using Curl
 * @param string  $api_url
 * @param string  $server_key
 * @param string  $request_body
 */
function chargeAPI($api_url, $server_key, $request_body){
  $ch = curl_init();
  $curl_options = array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POST => 1,
    CURLOPT_HEADER => 0,
    // Add header to the request, including Authorization generated from server key
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Accept: application/json',
      'Authorization: Basic ' . base64_encode($server_key . ':')
    ),
    CURLOPT_POSTFIELDS => $request_body
  );
  curl_setopt_array($ch, $curl_options);
  $result = array(
    'body' => curl_exec($ch),
    'http_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
  );
  return $result;
}
    }
}
