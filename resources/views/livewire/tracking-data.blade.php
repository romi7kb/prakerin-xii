<div>
    <div class="form-group row ">
        <div class="col-md-6">
        <label for="provinsi">Provinsi</label>
            <select wire:model="selectedProvinsi" class="form-control">
                <option value="" selected>pilih provinsi</option>
                @foreach($provinsi as $provinsis)
                    <option value="{{ $provinsis->id }}">{{ $provinsis->nama_prov }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
        <label for="positif">Jumlah Positif</label>
        <input type="text" class="form-control" name="positif" required>
        </div>
    </div> 

        <div class="form-group row ">
            <div class="col-md-6">
    @if(!is_null($selectedProvinsi))
            <label for="Kota">Kota</label>
                <select wire:model="selectedKota" class="form-control">
                    <option value="" selected>pilih kota</option>
                    @foreach($kota as $kota)
                        <option value="{{ $kota->id }}">{{ $kota->nama_kot }}</option>
                    @endforeach
                </select>
    @endif
            </div>
            <div class="col-md-6">
                <label for="sembuh">Jumlah Sembuh</label>
                <input type="text" class="form-control" name="sembuh" required>
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
    @if (!is_null($selectedKota))
            <label for="kecamatan">kecamatan</label>
                <select wire:model="selectedKecamatan" class="form-control">
                    <option value="" selected>pilih kecamatan</option>
                    @foreach($kecamatan as $kecamatans)
                        <option value="{{ $kecamatans->id }}">{{ $kecamatans->nama_kec }}</option>
                    @endforeach
                </select>
    @endif
            </div>
            <div class="col-md-6">
                <label for="meninggal">Jumlah Meninggal</label>
                <input type="text" class="form-control" name="meninggal" required>
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
    @if (!is_null($selectedKecamatan))
            <label for="kelurahan" >kelurahan</label>
                <select wire:model="selectedKelurahan" class="form-control">
                    <option value="" selected>pilih kelurahan</option>
                    @foreach($kelurahan as $kelurahans)
                        <option value="{{ $kelurahans->id }}">{{ $kelurahans->nama_kel }}</option>
                    @endforeach
                </select>
    @endif
            </div>
            <div class="col-md-6">
                <label for="tgl">Tanggal</label>
                <input type="date" class="form-control" name="tgl" required>
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
    @if (!is_null($selectedKelurahan))
            <label for="rw" >Rw</label>
                <select wire:model="selectedRw" class="form-control" name="id_rw">
                    <option value="" selected>pilih rw</option>
                    @foreach($rw as $rws)
                        <option value="{{ $rws->id }}">{{ $rws->no_rw }}</option>
                    @endforeach
                </select>
    @endif
            </div>
        </div>
</div>
