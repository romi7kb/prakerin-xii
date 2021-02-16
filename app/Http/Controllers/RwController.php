<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class RwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messeges = [
        'no_rw.required'=>'no rw tidak boleh kosong',
        'no_rw.max'=>'no rw masimal 2 karakter',
        'id_kel.required'=>'pilih kelurahan terlebih dahulu',
    ];
    public function index()
    {
        $rw = rw::with('Kelurahan')->get();
        return view('adminnice.rw.index',compact('rw'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelurahan = kelurahan::all();
        return view('adminnice.rw.create',compact('kelurahan'));
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
            'no_rw' => 'required|max:2',
            'id_kel' => 'required',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $rw = new Rw;
        $rw -> id_kel = $request->id_kel;
        $rw -> no_rw = $request->no_rw;
        $rw ->save();
        return redirect()->route('rw.index')->with(['tanda'=>'success','message'=>'Rw berhasil dibuat!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rw  $rw
     * @return \Illuminate\Http\Response
     */
    public function show(Rw $rw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rw  $rw
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $rw = rw::findOrFail($id);
        $kelurahan = kelurahan::all();
        return view('adminnice.rw.edit',compact('rw','kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rw  $rw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'no_rw' => 'required|max:2',
            'id_kel' => 'required',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $rw = rw::findOrFail($id);
        $rw -> id_kel = $request->id_kel;
        $rw -> no_rw = $request->no_rw;
        $rw ->save();
        return redirect()->route('rw.index')->with(['tanda'=>'warning','message'=>'Rw berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rw  $rw
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $rw = Rw::findOrFail($id);
        $rw->delete();
        return redirect()->route('rw.index')->with(['tanda'=>'danger','message'=>'Rw berhasil dihapus!']);
    }
}
