<?php

namespace App\Http\Controllers;

use App\Models\kupon;
use Illuminate\Http\Request;

class KuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =kupon::all();
        return response()->json([
            'status'=>'sukses',
            'data'=>$data
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=kupon::create($request->all());
        $data->save();
        return response()->jon([
            'status'=>'sukses',
            'data'=>$data
        ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */
    public function show(kupon $kupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */
    public function edit(kupon $kupon)
    {
        return response()->json([
            'status'=>'ok',
            'data'=>$kupon
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kupon $kupon)
    {
        $kupon->upddate($request->all());
        return response()->json([
            'status'=>'data berhasil di update',
            'data'=>$kupon,
        ]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kupon  $kupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(kupon $kupon)
    {
        $kupon->delete();
        return response()->json([
            'status'=>'data berhasil di hapus',
            
        ]);  
        //
    }
}
