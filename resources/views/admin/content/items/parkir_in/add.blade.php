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
                    <a href="{{ url('admin/parkir_in/create') }}"><span class="badge bg-dark p-2"><b
                                style="color: aliceblue"><i class="fas fa-sync-alt"></i> Refresh Page</b></span></a>
                    <form method="POST" action="{{ url('admin/parkir_in') }}" target="_blank"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Name Users -->
                        <div style="padding: 15px;">
                            {{-- <div class="row mb-3">

                                <div class="col-md-3" style="text-align: center; margin-top:6%;">
                                    <input type="button" class="btn btn-primary" value="Take Snapshot"
                                    onClick="take_snapshot()">
                                    <input type="button" onClick="window.location.reload()" value="Reset Data" class="btn btn-dark btn-sm mt-2">
                                </div>
                                <div class="col-md-4">
                                    <div id="my_camera"></div>
                                    <input type="hidden" name="image" class="image-tag">
                                </div>
                                <div class="col-md-4">
                                    <div id="results">Preview...</div>
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="plat" style="padding: 5px;"><b>No.Polisi</b></label>
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
                                <div class="col-md-3">
                                    <label for="kategori" style="padding: 5px; "><b>Type Kendaraan</b></label>
                                    <select id="kategori" type="text"
                                        class="form-control kategori-items @error('kategori') is-invalid @enderror"
                                        name="kategori" style="width: 100%; " required>
                                        <option selected disabled>-- Type Kendaran --</option>
                                        @foreach ($kategori as $row)
                                            <option value="{{ $row->id }}">  {{ $row->items }} |
                                                {{ number_format($row->price), 2, '.', '.' }} </option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="price" style="padding: 5px;"><b>Tarif Parkir</b></label>
                                    {{-- <input type="text" id="price"> --}}
                                    <input id="price" type="text" class="form-control text-center" name="price"
                                        value="{{ old('price') }}" required autocomplete="price" readonly>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-2">
                                    <label for="price2" style="padding: 5px;"><b>Kebersihan</b></label>
                                    {{-- <input type="text" id="price2"> --}}
                                    <input id="price2" type="text" class="form-control text-center" name="price2"
                                        value="{{ old('price2') }}" required autocomplete="price2" readonly>

                                    @error('price2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-2">
                                    <label for="total" style="padding: 5px;"><b>Total Bayar</b></label>
                                    {{-- <input type="text" id="total"> --}}
                                    <input id="total" type="text" class="form-control text-center" name="total"
                                        value="{{ old('total') }}" required autocomplete="total" readonly>

                                    @error('total')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                               
                            </div>
                            <hr>
                            <span>
                                <h6 style="font-size: 10px;"><b>informasi lainnya...</b></h6>
                            </span>
                            <div class="row mb-3">
                               
                                <div class="col-md-6">
                                    <label for="rombongan" style="padding: 5px;"><b>Asal Kota Rombongan</b></label>
                                    <input id="rombongan" type="text"
                                        class="form-control @error('rombongan') is-invalid @enderror" name="rombongan"
                                        value="{{ old('rombongan') }}" autocomplete="rombongan"
                                        placeholder="Asal Rombongan...">

                                    @error('rombongan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="porporasi" style="padding: 5px;"><b>Nomor Porporasi</b></label>
                                    <input id="porporasi" type="text"
                                        class="form-control @error('porporasi') is-invalid @enderror" name="porporasi"
                                        value="{{ old('porporasi') }}" required autocomplete="porporasi" required
                                        placeholder="No Tiket Porporasi...">

                                    @error('porporasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3" style="padding-top: 42px;">
                                    <button type="submit" class="btn btn-outline-primary w-80" style="float: right">
                                        <i class="fa fa-save"></i><b> Save & Print</b>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>

@endsection
@push('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }
    </style>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script> --}}
    <!-- Bootstrap theme -->

    {{-- <script>
        Webcam.set({
            width: 200,
            height: 200,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img style="width:100%; height:200px;" src="' +
                    data_uri + '"/>';
            });
        }
    </script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#kategori').select2({

            });
        });
    </script>
    {{-- autofill --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    <script>
        $('.kategori-items').on('change', (event) => {
            getData(event.target.value).then(data => {
                $('#price').val(data.data.price);
                $('#price2').val(data.data.price2);
                $('#total').val(data.data.price * 1 + data.data.price2 * 1 );
            });
        });

        async function getData(id) {
            //    let response = await fetch('/admin/kategori_items/' + id);
            let response = await fetch('/admin/kategori/items/' + id);
            let data = await response.json();
            //   console.info(data.data.price);
            return data;
        }
        // console.info('tes');
    </script>
@endpush
