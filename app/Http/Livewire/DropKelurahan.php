<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rw;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Tracking;

class DropKelurahan extends Component
{
    public $provinsi;
    public $kota;
    public $kecamatan;
    public $kelurahan;


    public $selectedProvinsi = null;
    public $selectedKota = null;
    public $selectedKecamatan = null;
    public $selectedKelurahan = null;
 

    public function mount($selectedKelurahan = null)
    {
        $this->provinsi = Provinsi::all();
        $this->kota = collect();
        $this->kecamatan = collect();
        $this->kelurahan = collect();
       
        $this->selectedKelurahan = $selectedKelurahan;
        if (!is_null(old('id_kel'))) {
            $this->selectedKelurahan = old('id_kel');

        }

        if (!is_null($selectedKelurahan)) {
            $kelurahan = kelurahan::with('kecamatan.kota.provinsi')->find($selectedKelurahan);
            
            if ($kelurahan) {
                $this->kecamatan = Kecamatan::where('id_kot', $kelurahan->kecamatan->id_kot)->get();
                $this->kota = Kota::where('id_prov', $kelurahan->kecamatan->kota->id_prov)->get();
                $this->selectedProvinsi =$kelurahan->kecamatan->kota->id_prov;
                $this->selectedKota = $kelurahan->kecamatan->id_kot;
                $this->selectedKecamatan = $kelurahan->id_kec;
            }
        }
    }

    public function render()
    {
        return view('livewire.drop-kelurahan');
    }

    public function updatedSelectedProvinsi($provinsi)
    {
        $this->kota = Kota::where('id_prov', $provinsi)->get();
        $this->selectedKota = NULL;
        $this->selectedKecamatan = NULL;
        $this->selectedKelurahan = NULL;
        $this->selectedRw = NULL;
        $this->kecamatan = [];
        $this->kelurahan = [];
        $this->rw = [];
    }
    public function updatedSelectedKota($kota)
    {
        $this->kecamatan = Kecamatan::where('id_kot', $kota)->get();
        $this->selectedKecamatan = NULL;
        $this->selectedKelurahan = NULL;
        $this->selectedRw = NULL;
        $this->kelurahan = [];
        $this->rw = [];
    }

    public function updatedSelectedKecamatan($kecamatan)
    {
        $this->kelurahan = Kelurahan::where('id_kec', $kecamatan)->get();
        $this->selectedKelurahan = NULL;
        $this->selectedRw = NULL;
        $this->rw = [];
    }
    
}
