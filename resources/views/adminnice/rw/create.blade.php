@extends('layouts.app-admin')
@section('css')
@endsection
@section('js')
@endsection
@section('active')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Tambah Rw</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin')}}">home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin/rw')}}">rw</a>
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
                            <form action="{{route('rw.store')}}" class="form-horizontal m-t-30" method="post">
                            @csrf
                            <div class="form-group">
                                <label>No RW</label>
                                <input type="text" class="form-control" name="no_rw" required>
                            </div>
                            <div class="form-group">
                                    <label>Input Select</label>
                                    <select class="custom-select col-12" id="inlineFormCustomSelect" name="id_kel">
                                        <option selected>pilih...</option>
                                        @foreach($kelurahan as $data)
                                        <option value="{{$data->id}}">{{$data->nama_kel}}</option>
                                        @endforeach
                                    </select>
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