@extends('layouts.app')

@section('title')
    About Us
@endsection

@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">About Us</li>
                </ol>
                </nav>
            </div>
            </div>
        </div>
        </section>
    <div class="page-content page-home">
        <section class="store-carousel">
        <div class="container">
            <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
                <div class="carousel slide" id="storeCarousel" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
                    <li data-target="#storeCarousel" data-slide-to="1"></li>
                    <li data-target="#storeCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="/images/about1.jpg" alt="Carousel Image" class="d-block w-90">
                    </div>
                    <div class="carousel-item">
                    <img src="/images/about2.jpg" alt="Carousel Image" class="d-block w-90">
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <h1>APOTEK RIZKI FARMA</h1>
                <h2> Apotek Rizki Farma Terletak Di  Jalan Sragen-Balong KM.12, Purworejo RT 07, Desa Sambirejo, Kecamatan Sambirejo, Sragen, Jawa Tengah</h2>
            </div>
            <div class="col-12 mb-5 mt-5">
                <center><h3>Contact Us On Whatsapp !</h3>
                <a href="https://wa.me/6282147693729" class="btn btn-success btn-block w-50 mt-2">
                Whatsapp
              </a></center>
            </div>
            </div>
        </div>

        </section>
