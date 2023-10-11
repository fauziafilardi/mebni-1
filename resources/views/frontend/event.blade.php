@extends('layouts.frontend.app')

@section('content')
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

<div class="whole-wrap">
    <div class="text-center mt-50 pl-10 pr-10">
        <h1 style="font-size: 24px;">
            MEBNI mengajak Anda untuk ikut berpartisipasi dalam Setiap kegiatan seru Bersama anggota MEBNI:
        </h1>
    </div>
    <div class="container box_1170">
        <div class="section-top-border">
            <div class="progress-table-wrap" style="border-radius: 15px; font-size: 15px;">
                <div class="progress-table">
                    <div class="table-head">
                        <div class="country">Event Name</div>
                        <div class="visit">Place</div>
                        <div class="visit">Event Date</div>
                        <div class="visit">Price</div>
                    </div>

                    @php
                    $no = 1;
                    @endphp

                    @foreach ($events as $key => $data)
                    <div class="table-row" onclick="openDetail('{{ $data->slug }}')" style="cursor: pointer;">
                        <div class="country"> <img src="{{ $data->image_path }}" alt="event" width="100px;">{{
                            $data->name }}</div>
                        <div class="visit">{{ $data->place }}</div>
                        <div class="visit">{{ $data->date }}</div>
                        <div class="visit">{{ $data->price }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">
                    <li class="page-item{{ $events->currentPage() === 1 ? ' disabled' : '' }}">
                        <a href="{{ $events->previousPageUrl() }}" class="page-link" aria-label="Previous">
                            <i class="ti-angle-left"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $events->lastPage(); $i++)
                        <li class="page-item{{ $i === $events->currentPage() ? ' active' : '' }}">
                            <a href="{{ $events->url($i) }}" class="page-link">{{ $i }}</a>
                        </li>
                        @endfor
                        <li class="page-item{{ $events->currentPage() === $events->lastPage() ? ' disabled' : '' }}">
                            <a href="{{ $events->nextPageUrl() }}" class="page-link" aria-label="Next">
                                <i class="ti-angle-right"></i>
                            </a>
                        </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content" style="font-size: 14px;">
            <div class="modal-header" style="align-items: center;">
                <h5 class="modal-title" id="exampleModalLabel" style="font-size: 14px;"></h5>
                <button type="button" class="genric-btn danger radius" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div>
            <div class="modal-body" style="padding-right: 30px; padding-left: 30px;">
                <div data-scroll="true" data-height="300">
                    <div id="modalContent">
                        <h1>Event Name</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="genric-btn mebni radius"
                            data-dismiss="modal" style="font-size: 14px;">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openDetail(slug) {
        $.ajax({
            url: 'event/' + slug,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let res = data.data;

                let html = '';
                    html += '<h1 class="text-center mb-5">'+ res.name +'</h1>';
                    html += '<div class="text-center mb-5"><img src="' + res.image_path + '" width="70%"/></div>';
                    html += '<div class="text-left"><p>Lokasi : '+ res.place +'</p><p>Waktu : '+ res.date +'</p><p>Biaya : Rp.'+ res.price +'</p><p> PIC : '+ res.pic +'</p></div>';
                    html += '<div class="text-left"><p>'+ res.description +'</p></div>';

                $('#modalContent').html(html);
                $('#exampleModalSizeSm').modal('show');
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }
</script>
@endsection
