@extends('layouts.frontend.app')

@section('content')
    <div class="slider-area" style="top: -150px;">
        <div class="slider-active dot-style">
            @foreach ($sliders as $key => $data)
            <div class="single-slider d-flex align-items-center slider-height" style="background-image: url('{{ $data->slider_path }}'); min-height: 80%; background-size: cover; background-position: center;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10 col-md-10 ">
                            <div class="hero-wrapper">
                                @if (!empty($data->youtube_url))
                                <div class="video-icon">
                                    <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=up68UAfH0d0"
                                        data-animation="bounceIn" data-delay=".4s">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                                @endif
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInUp" data-delay=".3s" style="font-size: 30px;">
                                        {{ $data->title }}
                                    </h1>
                                    <p data-animation="fadeInUp" data-delay=".6s" style="font-size: 20px;">{{ $data->description }}</p>
                                    @if (!empty($data->url))
                                    <a href="{{ $data->url }}" class="btn header-btn" data-animation="fadeInLeft"
                                        target="_blank" data-delay=".3s">Selengkapnya..</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="about-area2 section-padding40-custom" style="position: relative; top: -100px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <div class="about-img ">
                        <img src="{{ asset('assets/frontend/img/gallery/profile.jpg') }}" style="border-radius: 10px;" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="about-caption">
                        <div class="section-tittle mb-35">
                            <h2 class="text-center">Tentang MEBNI</h2>
                        </div>
                        <p class="pera-bottom mb-30" style="text-align: justify;">MEBNI sangat peduli terhadap kemajuan pengembangan teknologi Energi Nuklir untuk berbagai manfaat di bidang Energi Baru di Indonesia.</p>
                        <div class="icon-about">
                            <a href="{{ route('public.profile') }}" class="btn header-btn" style="border-radius: 15px;">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <section class="about-low-area mt-30" style="position: relative; top: -80px;">
        <div class="container">
            <div class="about-cap-wrapper">
                <div class="row">
                    <div class="col-xl-5  col-lg-6 col-md-10 offset-xl-1">
                        <div class="about-caption mb-50">
                            <div class="section-tittle mb-35">
                                <h2>Susunan Pengurus</h2>
                            </div>
                            <p>MEBNI diprakarsai oleh beberapa tokoh yang terdiri dari berbagai latar belakang mulai dari praktisi energi nuklir, akademisi, politisi, pakar energi, dan pengamat energi</p>
                            <a href="{{ route('public.organization') }}" class="btn header-btn" style="border-radius: 15px;">Baca Selengkapnya</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="about-img">
                            <div class="about-font-img">
                                <img src="{{ asset('assets/frontend/img/gallery/struktur-organisasi.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-blog-area section-padding30-custom" style="position: relative; top: -50px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9 col-sm-10">
                    <div class="section-tittle text-center mb-100">
                        <h2>Press Release & News Update</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($news_publications as $key => $data)
                <div class="col-lg-4 col-md-6">
                    <div class="home-blog-single mb-40">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="{{ $data->image_path }}" alt="{{ $data->title }}">
                            </div>
                            <div class="blog-cap">
                                <h3><a href="{{ $data->category == 'news' ? route('public.news_detail', [$data->slug]) : route('public.publication_detail', [$data->slug]) }}">{{ $data->title }}</a></h3>
                                <div style="display: flex; flex-direction: row; justify-content: space-between; font-size: 14px; margin-bottom: 15px">
                                    <div style="display: flex; justify-content: flex-start; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                            <style>svg{fill:#5aac4e}</style>
                                            <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/>
                                        </svg>
                                        <span style="padding-left: 10px; margin-bottom: 0px;">{{ $data->publish_date }}</span>
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <style>svg{fill:#5aac4e}</style>
                                            <path d="M168 80c-13.3 0-24 10.7-24 24V408c0 8.4-1.4 16.5-4.1 24H440c13.3 0 24-10.7 24-24V104c0-13.3-10.7-24-24-24H168zM72 480c-39.8 0-72-32.2-72-72V112C0 98.7 10.7 88 24 88s24 10.7 24 24V408c0 13.3 10.7 24 24 24s24-10.7 24-24V104c0-39.8 32.2-72 72-72H440c39.8 0 72 32.2 72 72V408c0 39.8-32.2 72-72 72H72zM176 136c0-13.3 10.7-24 24-24h96c13.3 0 24 10.7 24 24v80c0 13.3-10.7 24-24 24H200c-13.3 0-24-10.7-24-24V136zm200-24h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H376c-13.3 0-24-10.7-24-24s10.7-24 24-24zM200 272H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24zm0 80H408c13.3 0 24 10.7 24 24s-10.7 24-24 24H200c-13.3 0-24-10.7-24-24s10.7-24 24-24z"/>
                                        </svg>
                                        <span style="padding-left: 10px; margin-bottom: 0px;">{{ $data->category }}</span>
                                    </div>
                                </div>
                                <P style="text-align: justify;">
                                    {!! $data->short_description !!}
                                </P>
                                <div>
                                    <a href="{{ $data->category == 'news' ? route('public.news_detail', [$data->slug]) : route('public.publication_detail', [$data->slug]) }}" class="btn header-btn" style="border-radius: 15px;">Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="about-area2 section-padding40-custom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 mb-30">
                    <div class="about-caption">
                        <div class="section-tittle mb-35">
                            <h2 class="text-center">Gabung Bersama MEBNI</h2>
                        </div>
                        <p class="pera-bottom mb-30" style="text-align: justify;">Mari bergabung bersama MEBNI dan jadilah bagian dalam proses pengembangan Energi Baru Nuklir di Indonesia</p>
                        <div class="icon-about">
                            <a href="{{ route('public.membership') }}" class="btn header-btn" style="border-radius: 15px;">Gabung Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="about-img text-center">
                        <img src="{{ asset('assets/frontend/img/gallery/membership.png') }}" style="border-radius: 10px; text-align: center; width: 60%;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
