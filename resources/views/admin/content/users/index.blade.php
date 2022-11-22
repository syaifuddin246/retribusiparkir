@extends('admin.layouts.main')
@section('title', 'Management Users - Admin')
@section('management-users', 'active')
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
                        <h6 class="m-0 font-weight-bold text-primary">List Data User Account</h6>
                    </div>
                    <div class="col-md-8">
                        
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('admin/users_management/create') }}" class="btn btn-primary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-plus"></i> Add User Account</a>
                        <a href="{{ url('admin/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>No</th>
                                <th>Nama Petugas</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>History</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr class="text-center">
                                    <td>{{ $no++ }}</td>
                                    <td style="text-align: justify">{{$item->name}}</td>
                                    <td style="text-align: justify">{{$item->email}}</td>
                                    <td style="text-align: justify">{{$item->level}}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic-example">
                                            <a href="/admin/users_management/{{ $item->id }}/edit"
                                                class="btn btn-secondary btn-sm mr-1"><i class="fa fa-edit"></i>
                                                Edit</a>
                                            <a href="#" data-toggle="modal"
                                                data-target="#exampleModal{{ $item->id }}"
                                                class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i> Delete</a>
                                            <!-- Modal delete-->
                                            <form action="/admin/users_management/{{ $item->id }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
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
