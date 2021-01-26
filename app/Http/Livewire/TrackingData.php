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
        $this->kota = Kota::with('provinsi')->get();
        $this->kecamatan = Kecamatan::whereHas('kota', function ($query) {
            $query->whereId(request()->input('id_kot', 0));
        })->pluck('nama_kec', 'id');
        $this->kelurahan = Kelurahan::whereHas('kecamatan', function ($query) {
            $query->whereId(request()->input('id_kec', 0));
        })->pluck('nama_kel', 'id');
        $this->rw = Rw::whereHas('kelurahan', function ($query) {
            $query->whereId(request()->input('id_kel', 0));
        })->pluck('no_rw', 'id');
        $this->selectedRw = $selectedRw;
        $this->idt = $idt;
        if (!is_null($idt)) {
            $this->tracking1 = Tracking::findOrFail($idt);
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
    }
    public function updatedSelectedKota($kota)
    {
        $this->kecamatan = Kecamatan::where('id_kot', $kota)->get();
        $this->selectedKecamatan = NULL;
        $this->selectedKelurahan = NULL;
        $this->selectedRw = NULL;
    }

    public function updatedSelectedKecamatan($kecamatan)
    {
        $this->kelurahan = Kelurahan::where('id_kec', $kecamatan)->get();
        $this->selectedKelurahan = NULL;
        $this->selectedRw = NULL;
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
