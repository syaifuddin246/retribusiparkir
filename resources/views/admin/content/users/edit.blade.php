@extends('admin.layouts.main')
@section('title', 'Management Users - Admin')
@section('management-users', 'active')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data User Account</h6>
                </div>
                <div class="col-md-8">
                    <a href="{{ url('admin/users_management') }}" class="btn btn-secondary btn-sm"
                        style="float: right; margin-left:2px;"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
                    <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Password</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="card p-4">
                        <h4 class="text-center">Edit User Account</h4>
                        <form method="POST" action="{{ url('admin/users_management') . '/' . $data->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Name Users -->
                            <div class="p-5">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input for="name" id="name" type="text"
                                            class="form-control form-control-user @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') ? old('name') : $data->name }}" required
                                            autocomplete="name" placeholder="nama lengkap">

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
                                            name="email" value="{{ old('email') ? old('email') : $data->email }}" required
                                            autocomplete="email" readonly placeholder="email yang di daftarkan">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select for="level" id="level" type="level"
                                            class="form-control form-control-user @error('level') is-invalid @enderror"
                                            name="level" value="{{ old('level') ? old('level') : $data->level }}" required
                                            autocomplete="level" placeholder="level user">
                                            <option selected value="{{ old('level') ? old('level') : $data->level }}">
                                                {{ old('level') ? old('level') : $data->level }}</option>

                        
                                                <option value="admintembiring">Admin Tembiring</option>
                                                <option value="adminkadilangu">Admin Kadilangu</option>
                                            <option value="master">Admin Master</option>

                                        </select>
                                        @error('level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0 pt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary w-80 mb-3" style="float: right">
                                            <i class="fa fa-save"></i><b> Update Account</b>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card p-4">
                        <h4 class="text-center pt-4">Edit Password Account</h4>
                    <form method="post" action="{{ url('admin/users_management') . '/' . $data->id . '/editpass' }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="p-5">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input id="password" type="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="password baru"
                                    >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input id="password-confirm" type="password" class="form-control form-control-user"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="ulangi-password baru"
                                   >
                            </div>

                        </div>
                        <div class="row mb-0 pt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-80 mb-3" style="float: right">
                                    <i class="fa fa-save"></i><b> Update Password</b>
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>




        </div>
    </div>
@endsection
