<?php

namespace App\Http\Controllers;
use App\Models\Tracking;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Rw;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
        
        return view('adminnice.index',compact('positif','sembuh','meninggal','datapro'));
    }
}
