@extends('layouts.frontend.app')

@section('content')
<main>
    @if ($title == 'home')
    <!--? Slider Area Start-->
    <div class="slider-area">
        <div class="slider-active dot-style">
            <!-- Slider Single -->
            <div class="single-slider d-flex align-items-center slider-height">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-8 col-md-10 ">
                            <div class="hero-wrapper">
                                <!-- Video icon -->
                                <div class="video-icon">
                                    <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=up68UAfH0d0"
                                        data-animation="bounceIn" data-delay=".4s">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInUp" data-delay=".3s">Health is wealth keep it healthy
                                    </h1>
                                    <p data-animation="fadeInUp" data-delay=".6s">Almost before we knew it, we<br>
                                        had left the ground</p>
                                    <a href="services.html" class="btn" data-animation="fadeInLeft"
                                        data-delay=".3s">Take a Service</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slider Single -->
            <div class="single-slider d-flex align-items-center slider-height">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-8 col-md-10 ">
                            <div class="hero-wrapper">
                                <!-- Video icon -->
                                <div class="video-icon">
                                    <a class="popup-video btn-icon" href="https://www.youtube.com/watch?v=up68UAfH0d0"
                                        data-animation="bounceIn" data-delay=".4s">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInUp" data-delay=".3s">xxx
                                    </h1>
                                    <p data-animation="fadeInUp" data-delay=".6s">Almost before we knew it, we<br>
                                        had left the ground</p>
                                    <a href="#" class="btn" data-animation="fadeInLeft" data-delay=".3s">Take a
                                        Service</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End -->
    @else
    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div style="padding-left: 50px; padding-right: 50px;">
        {!! $data->content !!}
    </div>
</main>
@endsection
