@extends('layouts.app')

@section('content')
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1 class="text-light"><a href="index.html"><span>Tracking Covid</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About Us</a></li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <main id="main">
        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts  section-bg">
            <div class="container">
                <div class="section-title">
                    <h2>Global</h2>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <p><strong>Total Positif</strong> </p>
                            <i class="bi bi-emoji-frown"></i>
                            <span>{{ $topositif->value }}</span>
                            <p><strong>orang</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <p><strong>Total Sembuh</strong> </p>
                            <i class="bi bi-emoji-laughing"></i>
                            <span>{{ $tosembuh->value }}</span>
                            <p><strong>orang</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch ">
                        <div class="count-box ">
                            <p><strong>Total Meninggal</strong></p>
                            <i class="bi bi-emoji-dizzy"></i>
                            <span>{{ $tomeninggal->value }}</span>
                            <p><strong>orang</strong></p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                        <div class="count-box">
                            <i class="bi bi-emoji-frown indo"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $positif }}"
                                data-purecounter-duration="1" class="purecounter indo"></span>
                            <i class="bi bi-emoji-laughing indo"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $sembuh }}"
                                data-purecounter-duration="1" class="purecounter indo"></span>
                            <i class="bi bi-emoji-dizzy indo"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $meninggal }}"
                                data-purecounter-duration="1" class="purecounter indo"></span>
                            <p class="indo"><strong>Indonesia</strong></p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->
        <section>
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <h1 class="title font-bold">Provinsi</h1>
                            <table class="table" id="tabled">
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
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datapro as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data['nama_prov'] }}</td>
                                            <td>{{ $data['positif'] }}</td>
                                            <td>{{ $data['sembuh'] }}</td>
                                            <td>{{ $data['meninggal'] }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>











    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>Tracking Covid</h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Tracking Covid</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/Tracking Covid-free-bootstrap-template-creative/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    </div>
@endsection
