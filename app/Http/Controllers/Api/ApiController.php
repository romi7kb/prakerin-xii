<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rw;
use App\Models\Tracking;
use Illuminate\Support\Arr;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function provinsi()
    {
        $provinsi = Provinsi::all();
        $data = DB::table('provinsis')
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
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function getprovinsi($id)
    {
        $provinsi = Provinsi::whereId($id)->get();
        $data=[];
        $p=0;
        foreach ($provinsi as $prov) {
            $data[$p]['Kode Provinsi']=$prov->kode_prov;
            $data[$p]['Nama Provinsi']=$prov->nama_prov;
            $data[$p]['hari ini']['positif'] =0;
            $data[$p]['hari ini']['sembuh']=0;
            $data[$p]['hari ini']['meninggal']=0;
            $data[$p]['total']['positif'] =0;
            $data[$p]['total']['sembuh']=0;
            $data[$p]['total']['meninggal']=0;
            $tracking = tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
            foreach ($tracking as $track) {
                if ($track->rw->kelurahan->kecamatan->kota->provinsi->nama_prov == $prov->nama_prov) {
                    if ($track->tgl == date('Y-m-d')) {
                        $data[$p]['hari ini']['positif'] += $track->positif;
                        $data[$p]['hari ini']['sembuh']  += $track->sembuh;
                        $data[$p]['hari ini']['meninggal'] += $track->meninggal;
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }else {
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }
                   
                }
            }
            $p++;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function kota($idp)
    {

        $kota = kota::with('provinsi')->where('id_prov',$idp)->get();
        $data=[];
        $p=0;
        
        foreach ($kota as $prov) {
            
            $data[$p]['Kode Provinsi']=$prov->provinsi->kode_prov;
            $data[$p]['Nama Provinsi']=$prov->provinsi->nama_prov;
            $data[$p]['Kode Kota']=$prov->kode_kot;
            $data[$p]['Nama Kota']=$prov->nama_kot;
            $data[$p]['hari ini']['positif'] =0;
            $data[$p]['hari ini']['sembuh']=0;
            $data[$p]['hari ini']['meninggal']=0;
            $data[$p]['total']['positif'] =0;
            $data[$p]['total']['sembuh']=0;
            $data[$p]['total']['meninggal']=0;
            $tracking = tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
            foreach ($tracking as $track) {
                if ($track->rw->kelurahan->kecamatan->kota->nama_kot == $prov->nama_kot) {
                    if ($track->tgl == date('Y-m-d')) {
                        $data[$p]['hari ini']['positif'] += $track->positif;
                        $data[$p]['hari ini']['sembuh']  += $track->sembuh;
                        $data[$p]['hari ini']['meninggal'] += $track->meninggal;
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }else {
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }
                   
                }
            }
            $p++;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function allkota()
    {

        $kota = kota::all();
        $data=[];
        $p=0;
        
        foreach ($kota as $prov) {
            $data[$p]['Kode Kota']=$prov->kode_kot;
            $data[$p]['Nama Kota']=$prov->nama_kot;
            $data[$p]['hari ini']['positif'] =0;
            $data[$p]['hari ini']['sembuh']=0;
            $data[$p]['hari ini']['meninggal']=0;
            $data[$p]['total']['positif'] =0;
            $data[$p]['total']['sembuh']=0;
            $data[$p]['total']['meninggal']=0;
            $tracking = tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
            foreach ($tracking as $track) {
                if ($track->rw->kelurahan->kecamatan->kota->nama_kot == $prov->nama_kot) {
                    if ($track->tgl == date('Y-m-d')) {
                        $data[$p]['hari ini']['positif'] += $track->positif;
                        $data[$p]['hari ini']['sembuh']  += $track->sembuh;
                        $data[$p]['hari ini']['meninggal'] += $track->meninggal;
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }else {
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }
                   
                }
            }
            $p++;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function getkota($idp,$id)
    {

        $kota = kota::with('provinsi')->whereId($id)->where('id_prov',$idp)->get();
        $data=[];
        $p=0;
        
        foreach ($kota as $prov) {
            $data[$p]['Kode Provinsi']=$prov->provinsi->kode_prov;
            $data[$p]['Nama Provinsi']=$prov->provinsi->nama_prov;
            $data[$p]['Kode Kota']=$prov->kode_kot;
            $data[$p]['Nama Kota']=$prov->nama_kot;
            $data[$p]['hari ini']['positif'] =0;
            $data[$p]['hari ini']['sembuh']=0;
            $data[$p]['hari ini']['meninggal']=0;
            $data[$p]['total']['positif'] =0;
            $data[$p]['total']['sembuh']=0;
            $data[$p]['total']['meninggal']=0;
            $tracking = tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
            foreach ($tracking as $track) {
                if ($track->rw->kelurahan->kecamatan->kota->nama_kot == $prov->nama_kot) {
                    if ($track->tgl == date('Y-m-d')) {
                        $data[$p]['hari ini']['positif'] += $track->positif;
                        $data[$p]['hari ini']['sembuh']  += $track->sembuh;
                        $data[$p]['hari ini']['meninggal'] += $track->meninggal;
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }else {
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }
                   
                }
            }
            $p++;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function kecamatan()
    {
        $kecamatan = kecamatan::all();
        $data=[];
        $p=0;
        foreach ($kecamatan as $prov) {
            $data[$p]['Nama kecamatan']=$prov->nama_kec;
            $data[$p]['hari ini']['positif'] =0;
            $data[$p]['hari ini']['sembuh']=0;
            $data[$p]['hari ini']['meninggal']=0;
            $data[$p]['total']['positif'] =0;
            $data[$p]['total']['sembuh']=0;
            $data[$p]['total']['meninggal']=0;
            $tracking = tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
            foreach ($tracking as $track) {
                if ($track->rw->kelurahan->kecamatan->kota->nama_kec == $prov->nama_kec) {
                    if ($track->tgl == date('Y-m-d')) {
                        $data[$p]['hari ini']['positif'] += $track->positif;
                        $data[$p]['hari ini']['sembuh']  += $track->sembuh;
                        $data[$p]['hari ini']['meninggal'] += $track->meninggal;
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }else {
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }
                   
                }
            }
            $p++;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function kelurahan()
    {
        $kelurahan = kelurahan::all();
        $data=[];
        $p=0;
        foreach ($kelurahan as $prov) {
            $data[$p]['Nama kelurahan']=$prov->nama_kel;
            $data[$p]['hari ini']['positif'] =0;
            $data[$p]['hari ini']['sembuh']=0;
            $data[$p]['hari ini']['meninggal']=0;
            $data[$p]['total']['positif'] =0;
            $data[$p]['total']['sembuh']=0;
            $data[$p]['total']['meninggal']=0;
            $tracking = tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
            foreach ($tracking as $track) {
                if ($track->rw->kelurahan->nama_kel == $prov->nama_kel) {
                    if ($track->tgl == date('Y-m-d')) {
                        $data[$p]['hari ini']['positif'] += $track->positif;
                        $data[$p]['hari ini']['sembuh']  += $track->sembuh;
                        $data[$p]['hari ini']['meninggal'] += $track->meninggal;
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }else {
                        $data[$p]['total']['positif'] += $track->positif;
                        $data[$p]['total']['sembuh']  += $track->sembuh;
                        $data[$p]['total']['meninggal'] += $track->meninggal;
                    }
                   
                }
            }
            $p++;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function rw()
    {
        $npositif =tracking::where('tgl',date('Y-m-d'))->sum('positif');
        $nsembuh =tracking::where('tgl',date('Y-m-d'))->sum('sembuh');
        $nmeninggal =tracking::where('tgl',date('Y-m-d'))->sum('meninggal');
        $positif =tracking::sum('positif');
        $sembuh = tracking::sum('sembuh');
        $meninggal = tracking::sum('meninggal');
        $response= [
            'success' => true,
            'data' => ['hari ini' =>
                            [
                            'positif'=>$npositif,
                            'sembuh'=>$nsembuh,
                            'meninggal'=>$nmeninggal,
                        ],
                        'Total'=>
                        [
                            'positif'=>$positif,
                            'sembuh'=>$sembuh,
                            'meninggal'=>$meninggal,
                        ],
        ],
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function negara()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = 'https://api.kawalcorona.com';
        $res = json_decode($client->request('GET', $url)->getBody());
        $data=[];
        foreach ($res as $key => $value) {
            $data[$key]['nama_negara']=$value->attributes->Country_Region;
            $data[$key]['positif']=$value->attributes->Confirmed;
            $data[$key]['sembuh']=$value->attributes->Recovered;
            $data[$key]['meninggal']=$value->attributes->Deaths;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);

    }
    public function indonesia()
    {
        $positif = tracking::sum('positif');
        $sembuh  = tracking::sum('sembuh');
        $meninggal  = tracking::sum('meninggal');
        $response= [
            'success' => true,
            'data' => [
                        [
                            'Total positif'=>$positif,
                            'Total sembuh'=>$sembuh,
                            'Total meninggal'=>$meninggal,
                        ],
        ],
            'message' => 'berhasil',
        ];
        return response()->json($response);
    }
    public function positif()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = 'https://api.kawalcorona.com/positif';
        $positif = json_decode($client->request('GET', $url)->getBody());
        $response= [
            'status' => 200,
            'data' => [$positif
        ],
            'message' => 'berhasil',
        ];
        return response()->json($response,200);
    }
    public function sembuh()
    {
        
        $client = new Client(); //GuzzleHttp\Client
        $url = 'https://api.kawalcorona.com/sembuh';
        $sembuh = json_decode($client->request('GET', $url)->getBody());
        $response= [
            'status' => 200,
            'data' => [$sembuh
        ],
            'message' => 'berhasil',
        ];
        return response()->json($response,200);
    
    }
    public function meninggal()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = 'https://api.kawalcorona.com/meninggal';
        $meninggal = json_decode($client->request('GET', $url)->getBody());
        $response= [
            'status' => 200,
            'data' => [$meninggal
        ],
            'message' => 'berhasil',
        ];
        return response()->json($response,200);
    
    }
}
