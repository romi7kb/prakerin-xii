@extends('layouts.app-admin')
@section('css')
@endsection
@section('js')
@endsection
@section('active')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">RW </h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('admin')}}">home</a>
                                    </li>
                                   
                                    <li class="breadcrumb-item active" aria-current="page">RW</li>
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
                                <h4 class="card-title">Daftar rw <a class="btn btn-primary btn-sm btn-rounded" href="{{route('rw.create')}}"><i class="mdi mdi-plus"></i></a></h4>
                                
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabled">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">RW</th>
                                            <th scope="col">Kelurahan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no=1;
                                    @endphp
                                    @foreach($rw as $data)

                                        <tr>
                                            <th scope="row">{{$no++}}</th>
                                            <td>{{$data->no_rw}}</td>
                                            <td>{{$data->kelurahan->nama_kel}}</td>
                                            <td>
                                            <form action="{{route('rw.destroy',$data->id)}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning btn-sm btn-rounded " href="{{route('rw.edit',$data->id)}}"> <i class="mdi mdi-pencil"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm btn-rounded"><i class="mdi mdi-delete"></i></button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                
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