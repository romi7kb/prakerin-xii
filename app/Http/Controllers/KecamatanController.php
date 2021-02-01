<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kota;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messeges = [
        'nama_kec.required'=>'nama kecamatan tidak boleh kosong',
        'id.required'=>'id kecamatan tidak boleh kosong',
        'nama_kec.unique'=>'nama kecamatan sudah ada',
        'id.unique'=>'id kecamatan sudah ada',
        'id_kot.required'=>'pilih kota terlebih dahulu',
    ];
    public function index()
    {
        $kecamatan = Kecamatan::with('Kota')->get();
        return view('adminnice.kecamatan.index',compact('kecamatan'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kota = Kota::all();
        return view('adminnice.kecamatan.create',compact('kota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_kec' => 'required|unique:kecamatans',
            'id' => 'required|unique:kecamatans',
            'id_kot'=>'required'
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $kecamatan = new Kecamatan;
        $kecamatan -> id_kot = $request->id_kot;
        $kecamatan -> id = $request->id;
        $kecamatan -> nama_kec = $request->nama_kec;
        $kecamatan ->save();
        return redirect()->route('kecamatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kota = Kota::all();
        return view('adminnice.kecamatan.edit',compact('kecamatan','kota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = [
            'nama_kec' => 'required',
            'id' => 'required',
            'id_kot' => 'required'
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan -> id_kot = $request->id_kot;
        $kecamatan -> nama_kec = $request->nama_kec;
        $kecamatan -> id = $request->id;
        $kecamatan ->save();
        return redirect()->route('kecamatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();
        return redirect()->route('kecamatan.index');
    }
}
