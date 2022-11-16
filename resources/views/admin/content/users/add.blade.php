@extends('admin.layouts.main')
@section('title', 'Management Users - Admin')
@section('management-users', 'active')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data User Account</h6>
                </div>
                <div class="col-md-8">
                    <a href="{{ url('admin/users_management') }}" class="btn btn-secondary btn-sm"
                        style="float: right; margin-left:2px;"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">


            <div class="card p-4">
                <h4 class="text-center">Register Account</h4>
                <form method="POST" action="{{ url('admin/users_management') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Name Users -->
                    <div class="p-5">

                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input for="name" id="name" type="text"
                                        class="form-control form-control-user @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="nama lengkap">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input for="email" id="email" type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="email yang di daftarkan">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select for="level" id="level" type="level"
                                        class="form-control form-control-user @error('level') is-invalid @enderror"
                                        name="level" value="{{ old('level') }}" required autocomplete="level"
                                        placeholder="level user">
                                        <option selected disabled>-- pilih level user --</option>
                                        <option value="admin">Admin</option>
                                        <option value="master">Admin Master</option>

                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input id="password" type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password" placeholder="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input id="password-confirm" type="password" class="form-control form-control-user"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Ulangi-Password">
                                </div>
                            </div>
                            <div class="row mb-0 pt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary w-80 mb-3" style="float: right">
                                        <i class="fa fa-save"></i><b> Register Account</b>
                                    </button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
