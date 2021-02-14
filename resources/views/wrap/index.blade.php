@extends('layouts.app')

@section('content')
<div id="main-wrapper " >
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <div class="header1 po-relative bg-light ">
                    <div class="container">
                        <!-- Header 2 code -->
                        <nav class="navbar navbar-expand-lg h1-nav">
                          <a class="navbar-brand" href="#"></a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header1" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="ti-menu"></span>
                          </button>
                           
                          <div class="collapse navbar-collapse" id="header1">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                              <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
                              <li class="nav-item"><a class="nav-link" href="#">About </a></li>
                            </ul>
                          </div>
                        </nav>
                        <!-- End Header 1 code -->
                    </div>
        </div> 
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                
                <!-- ============================================================== -->
                <!-- Static Slider 10  -->
                <!-- ============================================================== -->
                <div class="static-slider10" style="background-image:url({{asset('assets/images/staticslider/slider10/img1.jpg')}}">
                    <div class="container">
                        <!-- Row  -->
                        <div class="row justify-content-center ">
                            <!-- Column -->
                            <div class="col-md-12 align-self-center text-center" data-aos="fade-down" data-aos-duration="1200">
                                <h1 class="title">Tracking Covid-19</h1>
                                <h6 class="subtitle op-8">Data covid 19 di seluruh Indonesia</h6>
                                <br>
                            </div>
                            <div class="col-md-3  pricing-box align-self-center">
                                <div class="card bg-danger text-light" >
                                
                                    <div class="card-body p-30 text-center" >
                                        <h5 class="text-light">Positif</h5>
                                        <span class="display-5">{{$positif}}</span>              
                                             
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- column  -->
                            <!-- column  -->
                            <div class="col-md-3  pricing-box align-self-center">
                                <div class="card bg-success text-light">
                                    <div class="card-body p-30 text-center">
                                        <h5 class="text-light">Sembuh</h5>
                                        <span class="display-5">{{$sembuh}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- column  -->
                            <!-- column  -->
                            <div class="col-md-3  pricing-box align-self-center">
                                <div class="card bg-warning text-light">
                                    <div class="card-body p-30 text-center">
                                        <h5 class="text-light">Meninggal</h5>
                                        <span class="display-5">{{$meninggal}}</span>
                                                                                
                                    </div>
                                </div>
                            </div>
                            <!-- column  -->
                            

                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Static Slider 10  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <h1 class="title font-bold">Provinsi</h1>
                                <table class="table"  id="tabled">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Provinsi</th>
                                            <th>Positif</th>
                                            <th>Sembuh</th>
                                            <th>Meninggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no=1;
                                        @endphp
                                        @foreach($datapro as $data)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$data['nama_prov']}}</td>
                                            <td>{{$data['positif']}}</td>
                                            <td>{{$data['sembuh']}}</td>
                                            <td>{{$data['meninggal']}}</td>
                                           
                                        </tr>
                                        @endforeach
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
         <!-- Back to top -->
            <!-- ============================================================== -->
            <a class="bt-top btn btn-circle btn-lg btn-info" href="#top"><i class="ti-arrow-up"></i></a>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer4 b-t spacer">
            <div class="container">
                <div class="f4-bottom-bar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex font-14">
                                <div class="m-t-10 m-b-10 copyright">All Rights Reserved by WrapPixel.</div>
                                <div class="links ml-auto m-t-10 m-b-10">
                                    <a href="#" class="p-10 p-l-0">Terms of Use</a>
                                    <a href="#" class="p-10">Legal Disclaimer</a>
                                    <a href="#" class="p-10">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
@endsection
