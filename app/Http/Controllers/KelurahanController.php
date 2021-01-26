<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = kelurahan::with('Kecamatan')->get();
        return view('adminnice.kelurahan.index',compact('kelurahan'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('adminnice.kelurahan.create',compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelurahan = new Kelurahan;
        $kelurahan -> id_kec = $request->id_kec;
        $kelurahan -> nama_kel = $request->nama_kel;
        $kelurahan ->save();
        return redirect()->route('kelurahan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kecamatan = kecamatan::all();
        return view('adminnice.kelurahan.edit',compact('kelurahan','kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $kelurahan = kelurahan::findOrFail($id);
        $kelurahan -> id_kec = $request->id_kec;
        $kelurahan -> nama_kel = $request->nama_kel;
        $kelurahan ->save();
        return redirect()->route('kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->delete();
        return redirect()->route('kelurahan.index');
    }
}
