@extends('layouts.app-admin')
@section('css')
@endsection
@section('js')
@endsection
@section('active')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Edit Kota</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin')}}">home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin/kota')}}">kota</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            <form action="{{route('kota.update', $kota->id)}}" class="form-horizontal m-t-30" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>Kode kota</label>
                                <input type="text" class="form-control" name="kode_kot" value="{{$kota->kode_kot}}" required>
                            </div>
                            <div class="form-group">
                                <label>Nama kota</label>
                                <input type="text" class="form-control" name="nama_kot" value="{{$kota->nama_kot}}" required>
                            </div>
                            <div class="form-group">
                                    <label>Input Select</label>
                                    <select class="custom-select col-12" id="inlineFormCustomSelect" name="id_prov">
                                    <option selected>pilih...</option>
                                        @foreach($provinsi as $data)
                                        <option 
                                        @if($kota->id_prov==$data->id)
                                        selected
                                        @endif
                                        value="{{$data->id}}">{{$data->nama_prov}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-info">Edit</button>
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