<?php

namespace App\Http\Controllers;

use App\Models\kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kurir=kurir::all();
        return response()->json([
            'status'=>'ok',
            'data'=>$kurir
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
        $kurir=kurir::create($request->all());
        $kurir->save();
        return response()->json([
            'status'=>'ok',
            'data'=>$kurir
        ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function show(kurir $kurir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function edit(kurir $kurir)
    {
        return response()->json([
            'status'=>'ok',
            'data'=>$kurir
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kurir $kurir)
    {
        $kurir->update($request->all());
        return response()->json([
            'status'=>'ok',
            'data'=>$kurir
        ]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kurir  $kurir
     * @return \Illuminate\Http\Response
     */
    public function destroy(kurir $kurir)
    {
        $kurir->delete();
        return response()->json([
            'status'=>'data berhasil di hapus'
        ]);
        //
    }
}
