@extends('layouts.app-admin')
@section('css')
@endsection
@section('js')
@endsection
@section('active')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Edit Data Kasus</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('admin') }}">home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('admin/tracking') }}">tracking</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('tracking.update', $tracking->id) }}" class="form-horizontal m-t-30"
                            method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    @livewire('tracking-data',['selectedRw' => $tracking->id_rw])
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="positif">Jumlah Positif</label>
                                            <input type="text" value="{{ $tracking->positif }} "
                                                class="form-control  @error('positif') is-invalid @enderror" name="positif">
                                            @error('positif')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="sembuh">Jumlah Sembuh</label>
                                            <input type="text" value="{{ $tracking->sembuh }} "
                                                class="form-control   @error('sembuh') is-invalid @enderror" name="sembuh">
                                            @error('sembuh')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-12">
                                            <label for="meninggal">Jumlah Meninggal</label>
                                            <input type="text" value="{{ $tracking->meninggal }} "
                                                class="form-control   @error('meninggal') is-invalid @enderror"
                                                name="meninggal">
                                            @error('meninggal')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-12">
                                            <label for="tgl">Tanggal</label>

                                            <input type="date" value="{{ date('Y-m-d',strtotime($tracking->tgl))}}"
                                                class="form-control   @error('tgl') is-invalid @enderror" name="tgl"
                                                value="{{ old('tgl') }}" readonly>
                                            @error('tgl')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info">edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
