@extends('layouts.app-admin')
@section('css')
@endsection
@section('js')
@endsection
@section('active')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
<section id="indo" class="counts section-bg">
            <div class="container ">
                <div class="section-title">
                    <h2>Indonesia</h2>
                </div>
                <div class="row no-gutters ">
                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch ">
                        <div class="count-box ">
                            <p><strong>Total Positif</strong> </p>
                            <img src="{{ asset('assets/img/icon-positif.png') }}" alt="">
                            <span><strong>{{ $positif }} orang</strong></span>
                            
                        </div>
                    </div>

                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch ">
                        <div class="count-box ">
                            <p><strong>Total Sembuh</strong> </p>
                            <img src="{{ asset('assets/img/icon-pdp.png') }}" alt="">
                            <span><strong>{{ $sembuh }} orang</strong></span>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch  ">
                        <div class="count-box  ">
                            <p><strong>Total Meninggal</strong></p>
                            <img src="{{ asset('assets/img/icon-odp.png') }}" alt="">
                            <span><strong> {{ $meninggal }} orang</strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </section>
        <section>
            <div class="container">
                <div class="row bg-white">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-striped  table-bordered align-middle " id="tabled">
                                <thead class="">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Provinsi</th>
                                        <th class="table-danger">Positif</th>
                                        <th class="table-warning">Sembuh</th>
                                        <th class="table-secondary">Meninggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datapro as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td><a style="color:black;" href="/kota/{{$data->id}}">{{ $data->nama_prov }}</a></td>
                                            <td class="table-danger">{{ $data->positif }}</td>
                                            <td class="table-warning">{{ $data->sembuh }}</td>
                                            <td class="table-secondary">{{ $data->meninggal}}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
@endsection