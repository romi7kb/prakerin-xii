@extends('layouts.app-admin')
@section('css')
@endsection
@section('js')
@endsection
@section('active')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Tambah Provinsi</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin')}}">home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin/provinsi')}}">provinsi</a>
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
                        <div class="card text-white bg-secondary">
                            <div class="card-body ">
                            <form action="{{route('provinsi.store')}}" class="form-horizontal m-t-30" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Kode Provinsi</label>
                                <input type="text" class="form-control @error('kode_prov') is-invalid @enderror" name="kode_prov" value="{{old('kode_prov')}}">
                                @error('kode_prov')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Provinsi</label>
                                <input type="text" class="form-control @error('nama_prov') is-invalid @enderror" name="nama_prov" value="{{old('nama_prov')}}">
                                @error('nama_prov')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-info">Tambah</button>
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