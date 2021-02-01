<div>
    <div class="form-group row ">
        <div class="col-md-6">
        <label for="provinsi">Provinsi</label>
            <select wire:model="selectedProvinsi" class="form-control ">
                <option value="" selected>pilih provinsi</option>
                @foreach($provinsi as $provinsis)
                    <option value="{{ $provinsis->id }}">{{ $provinsis->nama_prov }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
        <label for="positif">Jumlah Positif</label>
        <input type="text" value="@if(isset($tracking1)){{$tracking1->positif}}@endif" class="form-control  @error('positif') is-invalid @enderror" name="positif" >
        @error('positif')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        </div>
    </div> 

        <div class="form-group row ">
            <div class="col-md-6">
            <label for="Kota">Kota</label>
                <select wire:model="selectedKota" class="form-control ">
                    <option value="" selected>pilih kota</option>
                    @foreach($kota as $kota)
                        <option value="{{ $kota->id }}">{{ $kota->nama_kot }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="sembuh">Jumlah Sembuh</label>
                <input type="text"  value="@if(isset($tracking1)){{$tracking1->sembuh}}@endif" class="form-control   @error('sembuh') is-invalid @enderror" name="sembuh" >
                @error('sembuh')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
            <label for="kecamatan">kecamatan</label>
                <select wire:model="selectedKecamatan" class="form-control ">
                    <option value="" selected>pilih kecamatan</option>
                    @foreach($kecamatan as $kecamatans)
                        <option value="{{ $kecamatans->id }}">{{ $kecamatans->nama_kec }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="meninggal">Jumlah Meninggal</label>
                <input type="text"  value="@if(isset($tracking1)){{$tracking1->meninggal}}@endif" class="form-control   @error('meninggal') is-invalid @enderror" name="meninggal"  >
                @error('meninggal')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
            <label for="kelurahan" >kelurahan</label>
                <select wire:model="selectedKelurahan" class="form-control ">
                    <option value="" selected>pilih kelurahan</option>
                    @foreach($kelurahan as $kelurahans)
                        <option value="{{ $kelurahans->id }}">{{ $kelurahans->nama_kel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="tgl">Tanggal</label>
                <input type="date"  value="@if(isset($tracking1)){{$tracking1->tgl}}@endif"
                class="form-control   @error('tgl') is-invalid @enderror" name="tgl" value="{{old('tgl')}}" >
                @error('tgl')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
            <label for="rw" >Rw</label>
                <select wire:model="selectedRw" class="form-control @error('id_rw') is-invalid @enderror" name="id_rw">
                    <option value="" selected>pilih rw</option>
                    @foreach($rw as $rws)
                        <option 
                        
                        value="{{ $rws->id }}">{{ $rws->no_rw }}</option>
                    @endforeach
                </select>
                @error('id_rw')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
</div>
