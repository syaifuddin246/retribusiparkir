@extends('admin.layouts.main')
@section('title', 'Kategori Items')
@section('content-menu', 'show')
@section('content-kategori-items', 'active')
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
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Kategori Items</h6>
                    </div>
                    <div class="col-md-8">
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-home"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">


                <div class="card">
                    <form method="POST" action="{{ url('admin/kategori_items') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name Users -->
                        <div style="padding: 30px;">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="items" style="padding: 5px;"><b>Nama Kategori Items</b></label>
                                    <input id="items" type="text"
                                        class="form-control @error('items') is-invalid @enderror" name="items"
                                        value="{{ old('items') }}" required autocomplete="items" required
                                        placeholder="Nama Items...">

                                    @error('items')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="price" style="padding: 5px;"><b>Biaya</b></label>
                                    <input id="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ old('price') }}" required autocomplete="price" required
                                        placeholder="Price...">

                                    @error('price')
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
        <div class="card shadow mb-4">
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
        </div>
    </div>


@endsection
