<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Provinsi;

use Illuminate\Http\Request;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messeges = [
        'kode_kot.required'=>'kode kota tidak boleh kosong',
        'kode_kot.max'=>'kode provinsi tidak boleh lebih dari 4 karakter',
        'nama_kot.required'=>'nama kota tidak boleh kosong',
        'id_prov.required'=>'pilih provinsi terlebih dahulu',
        'kode_kot.unique'=>'kode kota sudah ada',
        'nama_kot.unique'=>'nama kota sudah ada',
    ];
    public function index()
    {
        $kota = Kota::with('Provinsi')->get();
        
        return view('adminnice.kota.index',compact('kota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::all();
        return view('adminnice.kota.create',compact('provinsi'));
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
            'kode_kot' => 'required|unique:kotas|max:4',
            'nama_kot' => 'required|unique:kotas',
            'id_prov' => 'required',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $kota = new Kota;
        $kota -> id_prov = $request->id_prov;
        $kota -> kode_kot = $request->kode_kot;
        $kota -> nama_kot = $request->nama_kot;
        $kota ->save();
        return redirect()->route('kota.index')->with(['tanda'=>'success','message'=>'kota berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function show(Kota $kota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kota = Kota::findOrFail($id);
        $provinsi = Provinsi::all();
        return view('adminnice.kota.edit',compact('kota','provinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'kode_kot' => 'required|max:4',
            'nama_kot' => 'required',
            'id_prov' => 'required',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $kota = Kota::findOrFail($id);
        $kota -> id_prov = $request->id_prov;
        $kota -> kode_kot = $request->kode_kot;
        $kota -> nama_kot = $request->nama_kot;
        $kota ->save();
        return redirect()->route('kota.index')->with(['tanda'=>'warning','message'=>'kota berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kota = Kota::findOrFail($id);
        $kota->delete();
        return redirect()->route('kota.index')->with(['tanda'=>'danger','message'=>'kota berhasil dihapus!']);
    }
}
