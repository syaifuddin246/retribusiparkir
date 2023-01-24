@extends('admin.layouts.main')
@section('title', 'Retribusi Wisata')
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
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="m-0 font-weight-bold text-primary">Retribusi Wisata</h6>
                    </div>
                    <div class="col-md-8">
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-home"></i></a>
                        <a href="{{ url('/admin/parkir_in') }}" class="btn btn-info btn-sm"
                            style="float: right; margin-left:2px;"><i class="fas fa-list"></i> List Retribusi Wisata</a>
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
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="rombongan" style="padding: 5px;"><b>Asal Rombongan Wisata</b></label>
                                    <input id="rombongan" type="text"
                                        class="form-control @error('rombongan') is-invalid @enderror" name="rombongan"
                                        value="{{ old('rombongan') }}" autocomplete="rombongan" required
                                        placeholder="Asal Rombongan...">

                                    @error('rombongan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <span>
                                <h6 style="font-size: 10px;"><b>informasi lainnya...</b></h6>
                            </span>
                            <div id="dynamic_form">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="fields[0][porporasi]" style="padding: 5px;"><b>No Porporasi Retribusi</b></label>
                                    <input type="text"
                                        class="form-control" id="fields[0][porporasi]" name="fields[0][porporasi]"
                                        value="{{ old('fields.0.porporasi') }}" required
                                        placeholder="No Porporasi Retribusi...">
                                </div>
                                <div class="col-md-4">
                                    <label for="fields[0][porporasi_kebersihan]" style="padding: 5px;"><b>No Porporasi Kebersihan</b></label>
                                    <input type="text"
                                        class="form-control" id="fields[0][porporasi_kebersihan]" name="fields[0][porporasi_kebersihan]"
                                        value="{{ old('fields.0.porporasi_kebersihan') }}" required
                                        placeholder="No Porporasi Kebersihan...">
                                </div>
                                <div class="col-md-3">
                                    <label for="fields[0][kategori]" style="padding: 5px; "><b>Tipe Kendaraan</b></label>
                                    <select id="fields[0][kategori]" type="text"
                                        class="form-control kategori-items @error('fields.0.kategori') is-invalid @enderror"
                                        name="fields[0][kategori]" style="width: 100%; " required>
                                        <option selected disabled>-- Tipe Kendaran --</option>
                                        @foreach ($kategori as $row)
                                            <option value="{{ $row->id }}">  {{ $row->items }} |
                                                {{ number_format($row->price), 2, '.', '.' }} + {{ number_format($row->price2), 2, '.', '.' }} </option>
                                        @endforeach
                                    </select>
                                    @error('fields.0.kategori')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-1">
                                    <label for="fields[0][jumlah]" style="padding: 5px;"><b>Jumlah</b></label>
                                    <input type="number" min="1" required
                                        class="form-control" id="fields[0][jumlah]" name="fields[0][jumlah]"
                                        value="{{ old('fields.0.jumlah', 1) }}">
                                </div>
                            </div>
                            </div>
                            <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah</button>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-12" style="padding-top: 4px;">
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
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }
    </style>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamic_form").append('<div class="row mb-3 r'+i+'"><div class="col-md-3"> <label for="fields['+i+'][porporasi]" style="padding: 5px;"><b>No Porporasi Retribusi</b></label> <input type="text" class="form-control" id="fields['+i+'][porporasi]" name="fields['+i+'][porporasi]" value="{{ old("fields.'+i+'.porporasi") }}" required placeholder="No Tiket Retribusi..."> </div> <div class="col-md-4"> <label for="fields['+i+'][porporasi_kebersihan]" style="padding: 5px;"><b>No Porporasi Kebersihan</b></label> <input type="text" class="form-control" id="fields['+i+'][porporasi_kebersihan]" name="fields['+i+'][porporasi_kebersihan]" value="{{ old("fields'+i+'porporasi_kebersihan") }}" required placeholder="No Porporasi Kebersihan..."> </div> <div class="col-md-3"> <label for="fields['+i+'][kategori]" style="padding: 5px; "><b>Tipe Kendaraan</b></label> <select id="fields['+i+'][kategori]" type="text" class="form-control kategori-items @error("fields.'+i+'.kategori") is-invalid @enderror" name="fields['+i+'][kategori]" style="width: 100%; " required> <option selected disabled>-- Tipe Kendaran --</option> @foreach ($kategori as $row) <option value="{{ $row->id }}">  {{ $row->items }} | {{ number_format($row->price), 2, ".", "." }} + {{ number_format($row->price2), 2, '.', '.' }}</option> @endforeach </select> @error("fields.'+i+'.kategori") <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror </div> <div class="col-md-1"> <label for="fields['+i+'][jumlah]" style="padding: 5px;"><b>Jumlah</b></label> <input type="number" min="1" class="form-control" id="fields['+i+'][jumlah]" name="fields['+i+'][jumlah]" value="{{ old("fields.'+i+'.jumlah", 1) }}" required> </div> <div class="col-md-1"> <label style="padding: 5px;"><b>&nbsp;</b></label> <button type="button" class="btn btn-outline-danger remove-input-field" onclick=remove('+i+')>Hapus</button> </div></div>'
                );
        });
        function remove(a) {
            $(".r"+a).remove();
        };
    </script>
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
