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
            <select wire:model="selectedKota" class="form-control "required>
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
            <select wire:model="selectedKecamatan" name="id_kec" class="form-control "required>
                <option value="" selected>pilih kecamatan</option>
                @foreach ($kecamatan as $kecamatans)
                    <option value="{{ $kecamatans->id }}">{{ $kecamatans->nama_kec }}</option>
                @endforeach
            </select>
        </div>

    </div>
   
    
</div>
