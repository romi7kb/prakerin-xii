<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rw;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $messeges = [
        'id_rw.required'=>'rw tidak boleh kosong',
        'id_rw.max'=>'rw tidak boleh lebih dari 2 karakter',
        'id_rw.unique'=>'data di rw ini sudah ada',
        'positif.required'=>'jumlah positif tidak boleh kosong',
        'sembuh.required'=>'jumlah sembuh tidak boleh kosong',
        'meninggal.required'=>'jumlah meninggal tidak boleh kosong',
        'tgl.required'=>'jumlah tanggal tidak boleh kosong',
    ];
    public function index()
    {
        $tracking = tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
        return view('adminnice.tracking.index',compact('tracking'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminnice.tracking.create');
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
            'id_rw' => 'required|unique:trackings|max:2',
            'positif'=>'required',
            'sembuh'=>'required',
            'meninggal'=>'required',
            'tgl'=>'required',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $tracking = new Tracking;
        $tracking -> id_rw = $request->id_rw;
        $tracking -> positif = $request->positif;
        $tracking -> sembuh = $request->sembuh;
        $tracking -> meninggal = $request->meninggal;
        $tracking -> tgl = $request->tgl;
        $tracking ->save();
        return redirect()->route('tracking.index')->with(['tanda'=>'success','message'=>'data berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $positif = tracking::sum('positif');
        $sembuh  = tracking::sum('sembuh');
        $meninggal  = tracking::sum('meninggal');

        $provinsi = Provinsi::all();
        $datapro = DB::table('provinsis')
                ->select('provinsis.id','kode_prov','nama_prov',
                    DB::raw('sum(trackings.positif) as positif'),
                    DB::raw('sum(trackings.sembuh) as sembuh'),
                    DB::raw('sum(trackings.meninggal) as meninggal'),
                )
                ->join('kotas', 'kotas.id_prov', '=', 'provinsis.id')
                ->join('kecamatans', 'kecamatans.id_kot', '=', 'kotas.id')
                ->join('kelurahans', 'kelurahans.id_kec', '=', 'kecamatans.id')
                ->join('rws', 'rws.id_kel', '=', 'kelurahans.id')
                ->join('trackings', 'trackings.id_rw', 'rws.id')
                ->groupBy('provinsis.id','kode_prov','nama_prov',)
                ->get();
        $client = new Client(); //GuzzleHttp\Client
        
        $topositif = json_decode($client->request('GET', 'https://api.kawalcorona.com/positif')->getBody());
        $tosembuh = json_decode($client->request('GET', 'https://api.kawalcorona.com/sembuh')->getBody());
        $tomeninggal = json_decode($client->request('GET', 'https://api.kawalcorona.com/meninggal')->getBody());
        $global = json_decode($client->request('GET', 'https://api.kawalcorona.com/')->getBody());
        return view('wrap.index',compact('positif','sembuh','meninggal','datapro','topositif','tosembuh','tomeninggal','global'));
    }
    public function showKot($id)
    {
        $positif = DB::table('kotas')
            ->select('kotas.nama_kot', 'kotas.kode_kot',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            ->join('provinsis', 'provinsis.id', '=', 'kotas.id_prov')
            ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('provinsis.id', $id)
            ->groupBy('provinsis.id')
            ->sum('trackings.positif');

        $sembuh = DB::table('kotas')
            ->select('kotas.nama_kot', 'kotas.kode_kot',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            ->join('provinsis', 'provinsis.id', '=', 'kotas.id_prov')
            ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('provinsis.id', $id)
            ->groupBy('provinsis.id')
            ->sum('trackings.sembuh');

        $meninggal = DB::table('kotas')
            ->select('kotas.nama_kot', 'kotas.kode_kot',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            ->join('provinsis', 'provinsis.id', '=', 'kotas.id_prov')
            ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('provinsis.id', $id)
            ->groupBy('provinsis.id')
            ->sum('trackings.meninggal');

        $datas = DB::table('kotas')
            ->select('kotas.id', 'kotas.nama_kot', 'kotas.kode_kot',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            ->join('provinsis', 'provinsis.id', '=', 'kotas.id_prov')
            ->join('kecamatans', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('provinsis.id', $id)
            ->groupBy('kotas.id','kotas.nama_kot', 'kotas.kode_kot')
            ->get();
        // dd($positif);
        $provinsi = Provinsi::findOrFail($id);
        
        return view('wrap.kota',compact('positif','sembuh','meninggal','datas','provinsi'));
    }
    public function showKec($id)
    {
        $positif = DB::table('kecamatans')
            ->select('kecamatans.nama_kec',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kotas.id', $id)
            ->groupBy('kotas.id')
            ->sum('trackings.positif');
            $sembuh = DB::table('kecamatans')
            ->select('kecamatans.nama_kec',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kotas.id', $id)
            ->groupBy('kotas.id')
            ->sum('trackings.sembuh');
            $meninggal = DB::table('kecamatans')
            ->select('kecamatans.nama_kec',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kotas.id', $id)
            ->groupBy('kotas.id')
            ->sum('trackings.meninggal');
            $datas = DB::table('kecamatans')
            ->select('kecamatans.id','kecamatans.nama_kec',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kot')
            ->join('kelurahans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kotas.id', $id)
            ->groupBy('kecamatans.id','kecamatans.nama_kec',)
            ->get();

        
        // dd($positif);
        $kota = Kota::findOrFail($id);
        
        return view('wrap.kecamatan',compact('positif','sembuh','meninggal','datas','kota'));
    }
    public function showKel($id)
    {
        $positif = DB::table('kelurahans')
            ->select('kelurahans.nama_kel',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kecamatans.id', $id)
            ->groupBy('kecamatans.id')
            ->sum('trackings.positif');

            $sembuh = DB::table('kelurahans')
            ->select('kelurahans.nama_kel',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kecamatans.id', $id)
            ->groupBy('kecamatans.id')
            ->sum('trackings.sembuh');
            $meninggal = DB::table('kelurahans')
            ->select('kelurahans.nama_kel',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kecamatans.id', $id)
            ->groupBy('kecamatans.id')
            ->sum('trackings.meninggal');
            $datas = DB::table('kelurahans')
            ->select('kelurahans.nama_kel','kelurahans.id',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kec')
            ->join('rws', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kecamatans.id', $id)
            ->groupBy('kelurahans.id','kelurahans.nama_kel',)
            ->get();
        
        
        // dd($positif);
        $kecamatan = kecamatan::findOrFail($id);
        
        return view('wrap.kelurahan',compact('positif','sembuh','meninggal','datas','kecamatan'));
    }
    public function showRW($id)
    {
        $positif = DB::table('rws')
            ->select('rws.no_rw',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kelurahans.id', $id)
            ->groupBy('kelurahans.id')
            ->sum('trackings.positif');

            $sembuh = DB::table('rws')
            ->select('rws.no_rw',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kelurahans.id', $id)
            ->groupBy('kelurahans.id')
            ->sum('trackings.sembuh');
            $meninggal = DB::table('rws')
            ->select('rws.no_rw',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kelurahans.id', $id)
            ->groupBy('kelurahans.id')
            ->sum('trackings.meninggal');
            $datas = DB::table('rws')
            ->select('rws.id','rws.no_rw',
                DB::raw('sum(trackings.positif) as positif'),
                DB::raw('sum(trackings.sembuh) as sembuh'),
                DB::raw('sum(trackings.meninggal) as meninggal'))
            
            ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kel')
            ->join('trackings', 'rws.id', '=', 'trackings.id_rw')
            ->where('kelurahans.id', $id)
            ->groupBy('rws.id','rws.no_rw',)
            ->get();
        
        
        // dd($positif);
        $kelurahan = kelurahan::findOrFail($id);
        
        return view('wrap.rw',compact('positif','sembuh','meninggal','datas','kelurahan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('adminnice.tracking.edit',compact('tracking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $rules = [
            'id_rw' => 'required|max:2',
            'positif'=>'required',
            'sembuh'=>'required',
            'meninggal'=>'required',
            'tgl'=>'required',
        ];
       
        $this->validate($request,$rules,$this->messeges);
        $tracking = Tracking::findOrFail($id);
        $tracking -> id_rw = $request->id_rw;
        $tracking -> positif = $request->positif;
        $tracking -> sembuh = $request->sembuh;
        $tracking -> meninggal = $request->meninggal;
        $tracking -> tgl = $request->tgl;
        $tracking ->save();
        return redirect()->route('tracking.index')->with(['tanda'=>'warning','message'=>'data berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $tracking = Tracking::findOrFail($id);
        $tracking->delete();
        return redirect()->route('tracking.index')->with(['tanda'=>'danger','message'=>'data berhasil dihapus!']);
    }
}
