<?php

namespace App\Http\Controllers;

use App\Models\paketLaundry;
use Illuminate\Http\Request;

class PaketLaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=paketLaundry::all();
        return response()->json([
            'status'=>'ok',
            'data'=>$data
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=paketLaundry::create($request->all())->save();
        return response()->json([
            'status'=>'ok',
            'data'=>$data
        ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\paketLaundry  $paketLaundry
     * @return \Illuminate\Http\Response
     */
    public function show(paketLaundry $paketLaundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\paketLaundry  $paketLaundry
     * @return \Illuminate\Http\Response
     */
    public function edit(paketLaundry $paketLaundry)
    {
        return response()->json([
            'status'=>'ok',
            'data'=>$paketLaundry
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\paketLaundry  $paketLaundry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, paketLaundry $paketLaundry)
    {
        
        $paketLaundry->update($request->all());
        return response()->json([
            'status'=>'ok',
            'data'=>$request->nama_paket
        ]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\paketLaundry  $paketLaundry
     * @return \Illuminate\Http\Response
     */
    public function destroy(paketLaundry $paketLaundry)
    {
        $paketLaundry->delete();
        return response()->json([
            'status'=>'ok',
            'data'=>'data berhasil di hapus'
        ]);
        //
    }
}
