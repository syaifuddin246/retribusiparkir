@extends('admin.layouts.main')
@section('title', 'Parkir In')
@section('parkir-in', 'active')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        @if (session()->has('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="m-0 font-weight-bold text-primary">Parkir In</h6>
                    </div>
                    <div class="col-md-8">
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-home"></i></a>
                        <a href="{{ url('/admin/parkir_in') }}" class="btn btn-info btn-sm"
                            style="float: right; margin-left:2px;"><i class="fas fa-list"></i> List Parkir In</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="card">
                    <form method="POST" action="{{ url('admin/parkir_in') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name Users -->
                        <div style="padding: 15px;">
                            <div class="row mb-3">
                                
                                <div class="col-md-3" style="text-align: center; margin-top:10%;">
                                    <input type="button" class="btn btn-dark" value="Take Snapshot" onClick="take_snapshot()">
                                </div>
                                <div class="col-md-4">
                                    <div id="my_camera"></div>
                                    <input type="hidden" name="image" class="image-tag">
                                </div>
                                <div class="col-md-4">
                                        <div id="results">Preview...</div>
                                </div>
                            </div>
                            <hr>
                                <div class="row mb-3">  
                                <div class="col-md-4">
                                    <label for="plat" style="padding: 5px;"><b>Plat Kendaraan</b></label>
                                    <input id="plat" type="text"
                                        class="form-control @error('plat') is-invalid @enderror" name="plat"
                                        value="{{ old('plat') }}" required autocomplete="plat" required
                                        placeholder="Nopol...">

                                    @error('plat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label for="kategori" style="padding: 5px; " ><b>Tarif Type Kendaraan</b></label>
                                    <select id="kategori" type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" style="width: 100%; " required>
                                        <option selected disabled>-- Tarif Type Kendaran --</option>
                                        @foreach ($kategori as $row)
                                            <option value="{{$row->id}}"> Rp. {{number_format($row->price), 2, '.', '.'}} | {{$row->items}}</option>
                                        @endforeach
                                      </select>
                                    @error('kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              
                                <div class="col-md-3" style="padding-top: 42px;">
                                    <button type="submit" class="btn btn-primary w-80" style="float: right">
                                        <i class="fa fa-save"></i><b> Save Data</b>
                                    </button>
                                </div>

                            </div>
                       
                        </div>
                    </form>
                </div>


            </div>
        </div>
        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="m-0 font-weight-bold text-primary">List Data Kategori Items</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>No</th>
                                <th>Nama Kategori Items</th>
                                <th>Biaya Parkir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $key => $row)
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->items }}</td>
                                    <td>{{ number_format($row->price), 2, '.', '.' }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic-example">

                                            <a href="/admin/kategori_items/{{ $row->id }}/edit"
                                                class="btn btn-secondary btn-sm mr-1"><i class="fa fa-edit"></i>
                                                </a>
                                            <a href="#" data-toggle="modal"
                                                data-target="#exampleModal{{ $row->id }}"
                                                class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i> </a>
                                            <!-- Modal delete-->
                                            <form action="/admin/kategori_items/{{ $row->id }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                    data-backdrop="static" data-keyboard="false">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete Data ?
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-left">Apakah Anda Yakin Ingin Menghapus Data
                                                                    Ini ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>


@endsection
@push('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container .select2-selection--single{
        height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height: 35px;
    }
</style>

{{-- capture --}}
<!-- Required library for webcam -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script>
<!-- Bootstrap theme -->

<script>
    
    Webcam.set({
        width: 200,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img style="width:100%; height:200px;" src="'+data_uri+'"/>';
        } );
    }

</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#kategori').select2({
        
        });
    });
</script>
@endpush