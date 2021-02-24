<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Provinsi;
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
                ->join('kotas', 'kotas.id_prov', '=', 'provinsis.id')
                ->join('kecamatans', 'kecamatans.id_kot', '=', 'kotas.id')
                ->join('kelurahans', 'kelurahans.id_kec', '=', 'kecamatans.id')
                ->join('rws', 'rws.id_kel', '=', 'kelurahans.id')
                ->join('trackings', 'trackings.id_rw', 'rws.id')
                ->select('kode_prov','nama_prov',
                    DB::raw('sum(trackings.positif) as positif'),
                    DB::raw('sum(trackings.sembuh) as sembuh'),
                    DB::raw('sum(trackings.meninggal) as meninggal'),
                )
                ->groupBy('nama_prov','kode_prov')
                ->get();
        $client = new Client(); //GuzzleHttp\Client
        $topositif = json_decode($client->request('GET', 'https://api.kawalcorona.com/positif')->getBody());
        $tosembuh = json_decode($client->request('GET', 'https://api.kawalcorona.com/sembuh')->getBody());
        $tomeninggal = json_decode($client->request('GET', 'https://api.kawalcorona.com/meninggal')->getBody());
        $global = json_decode($client->request('GET', 'https://api.kawalcorona.com/')->getBody());
        return view('wrap.index',compact('positif','sembuh','meninggal','datapro','topositif','tosembuh','tomeninggal','global'));
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
