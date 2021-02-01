<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messeges = [
        'kode_prov.required'=>'kode provinsi tidak boleh kosong',
        'kode_prov.max'=>'kode provinsi tidak boleh lebih dari 4 karakter',
        'nama_prov.required'=>'nama provinsi tidak boleh kosong',
        'kode_prov.unique'=>'kode provinsi sudah ada',
        'nama_prov.unique'=>'nama provinsi sudah ada',
    ];
    public function index()
    {
        $provinsi = Provinsi::all();
        return view('adminnice.provinsi.index',compact('provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminnice.provinsi.create');
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
            'kode_prov' => 'required|unique:provinsis|max:4',
            'nama_prov' => 'required|unique:provinsis',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $provinsi = new Provinsi;
        $provinsi -> kode_prov = $request->kode_prov;
        $provinsi -> id = $request->kode_prov;
        $provinsi -> nama_prov = $request->nama_prov;
        $provinsi ->save();
        return redirect()->route('provinsi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show(Provinsi $provinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('adminnice.provinsi.edit',compact('provinsi'));
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = [
            'kode_prov' => 'required|max:4',
            'nama_prov' => 'required',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $provinsi = Provinsi::findOrFail($id);
        $provinsi -> kode_prov = $request->kode_prov;
        $provinsi -> id = $request->kode_prov;
        $provinsi -> nama_prov = $request->nama_prov;
        $provinsi ->save();
        return redirect()->route('provinsi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $provinsi)
    {
        $provinsi->delete();
        return redirect()->route('provinsi.index');
    }
}
