<?php

namespace App\Http\Livewire;

use App\Models\Rw;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Tracking;
use Livewire\Component;

class TrackingData extends Component
{
    public $provinsi;
    public $kota;
    public $kecamatan;
    public $kelurahan;
    public $rw;
    public $tracking1;
    public $idt;

    public $selectedProvinsi = null;
    public $selectedKota = null;
    public $selectedKecamatan = null;
    public $selectedKelurahan = null;
    public $selectedRw = null;

    public function mount($selectedRw = null, $idt = null)
    {
        $this->provinsi = Provinsi::all();
        $this->kota = collect();
        $this->kecamatan = collect();
        $this->kelurahan = collect();
        $this->rw = collect();
        $this->selectedRw = $selectedRw;
        $this->idt = $idt;
        if (!is_null($idt)) {
            $this->tracking1 = Tracking::findOrFail($idt);
        }
        if (!is_null(old('id_rw'))) {
            $this->selectedRw = old('id_rw');

        }

        if (!is_null($selectedRw)) {
            $rw = Rw::with('kelurahan.kecamatan.kota.provinsi')->find($selectedRw);
            
            if ($rw) {
                $this->rw = RW::where('id_kel', $rw->id_kel)->get();
                $this->kelurahan = Kelurahan::where('id_kec', $rw->kelurahan->id_kec)->get();
                $this->kecamatan = Kecamatan::where('id_kot', $rw->kelurahan->kecamatan->id_kot)->get();
                $this->kota = Kota::where('id_prov', $rw->kelurahan->kecamatan->kota->id_prov)->get();
                $this->selectedProvinsi =$rw->kelurahan->kecamatan->kota->id_prov;
                $this->selectedKota = $rw->kelurahan->kecamatan->id_kot;
                $this->selectedKecamatan = $rw->kelurahan->id_kec;
                $this->selectedKelurahan = $rw->id_kel;
            }
        }
    }

    public function render()
    {
        return view('livewire.tracking-data');
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
    public function updatedSelectedKelurahan($kelurahan)
    {
        if (!is_null($kelurahan)) {
            $this->rw = RW::where('id_kel', $kelurahan)->get();
        }else{
            $this->selectedRw = NULL;

        }
    }
}
