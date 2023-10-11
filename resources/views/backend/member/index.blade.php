@extends('layouts.backend.app')

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">News & Publication</h3>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>News / Publication Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($datas as $key => $data )
                            <tr class="custom-table" onclick="openDetail('{{ $data->slug }}')" style="cursor: pointer;">
                                <td>{{ $no++ }}</td>
                                <td>
                                    <div style="display: flex; flex-direction: row;">
                                        <div><img src="{{ $data->image_path }}" alt="" width="50px"></div>
                                        <div class="pl-5">{{ $data->title }}</div>
                                    </div>
                                </td>
                                <td>{{ $data->short_description }}</td>
                                <td>{{ $data->category }}</td>
                                <td>{{ $data->content_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">News / Publication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalContent">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openDetail(slug) {
        $.ajax({
            url: 'member/' + slug,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let res = data.data;

                let html = '';
                    html += '<h1 class="text-center mb-5">'+ res.title +'</h1>';
                    html += '<div class="text-center mb-5"><img src="' + res.image_path + '" width="70%"/></div>';
                    html += '<div class="text-left"><p>'+ res.content +'</p></div>';

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
