<div>
    <div class="form-group row ">
        <div class="col-md-12">
            <label for="provinsi">Provinsi</label>
            <select wire:model="selectedProvinsi" class="form-control " required>
                <option value="" selected>pilih provinsi</option>
                @foreach ($provinsi as $provinsis)
                    <option value="{{ $provinsis->id }}">{{ $provinsis->nama_prov }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-group row ">
        <div class="col-md-12">
            <label for="Kota">Kota</label>
            <select wire:model="selectedKota" class="form-control " required>
                <option value="" selected>pilih kota</option>
                @foreach ($kota as $kota)
                    <option value="{{ $kota->id }}">{{ $kota->nama_kot }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-group row ">
        <div class="col-md-12">
            <label for="kecamatan">kecamatan</label>
            <select wire:model="selectedKecamatan" class="form-control " required>
                <option value="" selected>pilih kecamatan</option>
                @foreach ($kecamatan as $kecamatans)
                    <option value="{{ $kecamatans->id }}">{{ $kecamatans->nama_kec }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-group row ">
        <div class="col-md-12">
            <label for="kelurahan">kelurahan</label>
            <select wire:model="selectedKelurahan" class="form-control " required>
                <option value="" selected>pilih kelurahan</option>
                @foreach ($kelurahan as $kelurahans)
                    <option value="{{ $kelurahans->id }}">{{ $kelurahans->nama_kel }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-group row ">
        <div class="col-md-12">
            <label for="rw">Rw</label>
            <select wire:model="selectedRw" class="form-control @error('id_rw') is-invalid @enderror" name="id_rw">
                <option value="" selected>pilih rw</option>
                @foreach ($rw as $rws)
                    <option value="{{ $rws->id }}">{{ $rws->no_rw }}</option>
                @endforeach
            </select>
            @error('id_rw')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
