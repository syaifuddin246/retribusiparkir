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
                    <form method="POST" action="{{ url('admin/parkir_in') }}" target="_blank"
                        enctype="multipart/form-data" >
                        @csrf
                        <!-- Name Users -->
                        <div style="padding: 15px;">
                            <div class="row mb-3">

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
                                    <label for="kategori" style="padding: 5px; "><b>Tarif Type Kendaraan</b></label>
                                    <select id="kategori" type="text"
                                        class="form-control @error('kategori') is-invalid @enderror" name="kategori"
                                        onChange="tampil(this.value)" style="width: 100%; " required>
                                        <option selected disabled>-- Tarif Type Kendaran --</option>
                                        @foreach ($kategori as $row)
                                            <option value="{{ $row->id }}"> Rp.
                                                {{ number_format($row->price), 2, '.', '.' }} | {{ $row->items }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-2">
                                    <label for="status" style="padding: 5px;"><b>Tarif</b></label>

                                    <input id="price" type="text" class="form-control text-center" name="status"
                                        value="{{ old('status') }}" required autocomplete="status" readonly>

                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div> --}}

                                <div class="col-md-3" style="padding-top: 42px;">
                                    <button type="submit" class="btn btn-outline-primary w-80" style="float: right" >
                                        <i class="fa fa-save" ></i><b> Save & Print</b>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>


            </div>
        </div>

    </div>
    {{-- <form action="" id="myform">
        <input type="submit" value="">
    </form> --}}

    {{-- <form>
        <select name="kategori" onChange="tampil(this.value)">
            @foreach ($kategori as $item)
                <option value="{{ $item->id }}"> Rp.
                    {{ number_format($item->price), 2, '.', '.' }} | {{ $item->items }}</option>
            @endforeach
        </select>
    </form> --}}

    {{-- <div id="price"></div> --}}

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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script>
    <!-- Bootstrap theme -->

    <script>
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
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#kategori').select2({

            });
        });
    </script>
    <script type="text/javascript">
        function tampil(kategori) {
            let data = "";
            switch (kategori) {
                case "1": {
                    data = 190000;
                }
                break;
            case "2": {
                data = 90000;
            }
            break;
            default:
                data = "";
            }
            document.getElementById('price').value = data;
        }
    </script>

    {{-- <script>
        $('#myform').submit(function(event){
            
    event.preventDefault();
});
    </script> --}}
    
    
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#kategori').select2({

            })
        });
        
        $('#kategori').on('change', (event) => {
            getBarang(event.target.value).then(data => {
                $('#kategori').val(data.price);
            });
        });
        async function getBarang(id) {
            let response = await fetch('/kategori/data/' + id)
            let data = await response.json();

            return data;
        }
    </script> --}}

    {{-- <script>
    console.info('tes')
</script> --}}
    {{-- <script>
        $('#kategori').on('change', (event) => {
            getBarang(event.target.value).then(data => {
                $('#harga').val(data.price);
            });
        });
        async function getBarang(id) {
            let response = await fetch('/kategori/data/' + id)
            let data = await response.json();

            return data;
        }
    </script> --}}
@endpush
