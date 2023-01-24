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
                        <h6 class="m-0 font-weight-bold text-primary">Retribusi</h6>
                    </div>
                    <div class="col-md-8">
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-home"></i></a>
                        <a href="{{ url('/admin/parkir_in') }}" class="btn btn-info btn-sm"
                            style="float: right; margin-left:2px;"><i class="fas fa-list"></i> List Retribusi</a>
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
                        <div class="col-md-12 pt-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" value="tambah form" id="addButton" class="btn btn-info">
                                        +
                                    </button>
                                    <button type="button" value="delete form" id="removeButton" class="btn btn-danger">
                                        -
                                    </button>
                                </div>
                                <div class="col-md-3">

                                    <input id="plat" type="text"
                                        class="form-control @error('plat') is-invalid @enderror" name="plat"
                                        value="{{ old('plat') }}" autocomplete="plat" placeholder="Nomor Polisi...">

                                    @error('plat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3"><b style="float: right">SUB TOTAL</b></div>
                                <div class="col-md-3">
                                    <input id="subtotal" type="text" class="form-control text-center" name="total"
                                        readonly>
                                </div>
                            </div>

                        </div>
                        <!-- Name Users -->
                        <div style="padding: 15px;">

                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <label for="kategori" style="padding: 5px; "><b>Kategori Kendaraan</b></label>
                                    <select id="kategori" type="text"
                                        class="form-control kategori-items @error('kategori') is-invalid @enderror"
                                        name="kategori" style="width: 100%; " required>
                                        <option selected disabled>-- Kategori --</option>
                                        @foreach ($kategori as $row)
                                            <option value="{{ $row->id }}"> {{ $row->items }} |
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
                                    <label for="jml" style="padding: 5px;"><b>Jml Datang</b></label>
                                    <input type="text" id="jumlah" onkeyup="sum();" value=""
                                        class="form-control @error('jml') is-invalid @enderror" name="jml"
                                        autocomplete="jml">

                                    @error('jml')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="price" style="padding: 5px;"><b>Retribusi</b></label>
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
                                    <label for="total" style="padding: 5px;"><b>Jumlah</b></label>
                                    {{-- <input type="text" id="total"> --}}
                                    <input id="total" type="text" class="form-control text-center" name="total"
                                        value="{{ old('total') }}" required autocomplete="total" readonly>

                                    @error('total')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div id="add_input">
                                    {{-- new inputan --}}
                                </div>
                            </div>
                          
                    
                            <span>
                                <h6 style="font-size: 10px;"><b>informasi lainnya...</b></h6>
                            </span>
                            <div class="row mb-3">
                                <div class="col-md-4">
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
                                    <label for="porporasi" style="padding: 5px;"><b>Porporasi Kunjungan</b></label>
                                    <input id="porporasi" type="text"
                                        class="form-control @error('porporasi') is-invalid @enderror" name="porporasi"
                                        value="{{ old('porporasi') }}" required autocomplete="porporasi" required
                                        placeholder="No Porporasi...">

                                    @error('porporasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="porporasi" style="padding: 5px;"><b>Porporasi Kebersihan</b></label>
                                    <input id="porporasi" type="text"
                                        class="form-control @error('porporasi') is-invalid @enderror" name="porporasi"
                                        value="{{ old('porporasi') }}" required autocomplete="porporasi" required
                                        placeholder="No Porporasi...">

                                    @error('porporasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2" style="padding-top: 42px;">
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
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }
    </style>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#kategori').select2({

            });
        });
    </script> --}}
    <script>
        $('.kategori-items').on('change', (event) => {
            getData(event.target.value).then(data => {
                $('#price').val(data.data.price);
                $('#price2').val(data.data.price2);
                $('#total').val(data.data.price * 1 + data.data.price2 * 1);
            });
        });
        
        function sum() {
            var txtFirstNumberValue = document.getElementById('jumlah').value;
            var txtSecondNumberValue = document.getElementById('total').value;
            var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('subtotal').value = result;
            }
        }

        async function getData(id) {
            //    let response = await fetch('/admin/kategori_items/' + id);
            let response = await fetch('/admin/kategori/items/' + id);
            let data = await response.json();
            //   console.info(data.data.price);
            return data;
        }
        // console.info('tes');
    </script>
    <script>
        let counter = 1
        $('#addButton').click(function (e){
            counter++
            
            let newInput = `
            <div id="hapus">
            <div class="col-md-12 pt-2">
                   
                        <!-- Name Users -->
                       

                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <label for="kategori" style="padding: 5px; "><b>Kategori Kendaraan</b></label>
                                    <select id="kategori" type="text"
                                        class="form-control kategori-items @error('kategori') is-invalid @enderror"
                                        name="kategori" style="width: 100%; " required>
                                        <option selected disabled>-- Kategori --</option>
                                        @foreach ($kategori as $row)
                                            <option value="{{ $row->id }}"> {{ $row->items }} |
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
                                    <label for="jml" style="padding: 5px;"><b>Jml Datang</b></label>
                                    <input type="text" id="jumlah" onkeyup="sum();" value=""
                                        class="form-control @error('jml') is-invalid @enderror" name="jml"
                                        autocomplete="jml">

                                    @error('jml')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="price" style="padding: 5px;"><b>Retribusi</b></label>
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
                                    <label for="total" style="padding: 5px;"><b>Jumlah</b></label>
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

                </div>
            `
            $('#add_input').append(newInput)
        });
        $('#removeButton').click(function (e){

            $('#hapus').remove()
            counter--
        });
    </script>
@endpush
