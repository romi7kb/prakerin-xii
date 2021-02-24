@extends('layouts.app')

@section('content')
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1 class="text-light"><a href=""><span>COOVI69</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#counts">Global</a></li>
                    <li><a class="nav-link scrollto" href="#indo">Indonesia</a></li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <section id="hero">
    <div class="hero-container" data-aos="fade-up">
      <h1>COOVI-69</h1>
      <h2>Coronavirus Global & Indonesia Live Data</h2>
      <a href="#main" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>
    </div>
  </section><!-- End Hero -->
    <main id="main" class="page" >
        <div class="hero-container" data-aos="fade-up">
            <h1>Tracking Covid</h1>
            <h2>Coronavirus Global & Indonesia Live Data</h2>
            <a href="#main" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>
        </div>
    </section><!-- End Hero -->
    <main id="main" class="page">
>>>>>>> 4159aed9721cc4e59b23be82eb0dab46a0fcb347
        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts section-bg">
            <div class="container align-items-center">
                <div class="section-title">
                    <h2>Global</h2>
                </div>
                <div class="row no-gutters ">
                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch ">
                        <div class="count-box ">
                            <p><strong>Total Positif</strong> </p>
                            <img src="{{ asset('assets/img/icon-positif.png') }}" alt="">
                            <span>{{ $topositif->value }}</span>
                            <p><strong>orang</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch ">
                        <div class="count-box ">
                            <p><strong>Total Sembuh</strong> </p>
                            <img src="{{ asset('assets/img/icon-pdp.png') }}" alt="">
                            <span>{{ $tosembuh->value }}</span>
                            <p><strong>orang</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch  ">
                        <div class="count-box  ">
                            <p><strong>Total Meninggal</strong></p>
                            <img src="{{ asset('assets/img/icon-odp.png') }}" alt="">
                            <span>{{ $tomeninggal->value }}</span>
                            <p><strong>orang</strong></p>
                        </div>
                    </div>
                </div>


            </div>
        </section><!-- End Counts Section -->
        <section>
            <div class="container">
                <div class="row bg-white">
                    <div class="col-md-12">
                        <div class="table-responsive ">

                            <table class="table table-striped table-bordered align-middle" id="tabled2">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Negara</th>
                                        <th class="table-danger">Positif</th>
                                        <th class="table-warning">Sembuh</th>
                                        <th class="table-secondary">Meninggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($global as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->attributes->Country_Region }}</td>
                                            <td class="table-danger">{{ $data->attributes->Confirmed }}</td>
                                            <td class="table-warning">{{ $data->attributes->Recovered }}</td>
                                            <td class="table-secondary">{{ $data->attributes->Deaths }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                            <span>{{ $positif }}</span>
                            <p><strong>orang</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch ">
                        <div class="count-box ">
                            <p><strong>Total Sembuh</strong> </p>
                            <img src="{{ asset('assets/img/icon-pdp.png') }}" alt="">
                            <span>{{ $sembuh }}</span>
                            <p><strong>orang</strong> </p>
                        </div>
                    </div>

                    <div class="col-lg-4  col-md-8 d-md-flex align-items-md-stretch  ">
                        <div class="count-box  ">
                            <p><strong>Total Meninggal</strong></p>
                            <img src="{{ asset('assets/img/icon-odp.png') }}" alt="">
                            <span>{{ $meninggal }}</span>
                            <p><strong>orang</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row bg-white">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-striped  table-bordered align-middle " id="tabled">
                                <thead class="table-dark">
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
                                            <td>{{ $data->nama_prov }}</td>
                                            <td class="table-danger">{{ $data->positif }}</td>
                                            <td class="table-warning">{{ $data->sembuh }}</td>
<<<<<<< HEAD
                                            <td class="table-secondary">{{ $data->meninggal}}</td>
=======
                                            <td class="table-secondary">{{ $data->meninggal }}</td>
>>>>>>> 4159aed9721cc4e59b23be82eb0dab46a0fcb347

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
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>COOVI-69</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/COOVI-69-free-bootstrap-template-creative/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    </div>
@endsection
