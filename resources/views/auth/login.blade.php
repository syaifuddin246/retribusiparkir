@extends('layouts.main')
@section('title','Parkir-App')

@section('content')
<div class="col-xl-5 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-4">
                        <div class="text-center">
                            {{-- <img src="{{asset('sb_admin2/img/logo.png')}}" alt="" class="img-fluid"> --}}
                            <h1 class="h4 text-gray-900 mb-4">Parkir-App</h1>
                            <hr>
                        </div>
                        <form class="user" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Your Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                            
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark btn-user btn-block ">
                                <i class="fas fa-door-open"></i> Login
                            </button>
                            {{-- <a href="{{url('/')}}" class="btn btn-dark btn-user btn-block"> <i class="fas fa-home"></i> Home</a> --}}
                            <hr>
                            @if (Route::has('password.request'))
                                <div class="text-center pb-2">
                                    <a class="small" href="{{ url('/') }}">
                                        <i class="fas fa-home"></i> Home
                                    </a> | 
                                    <a class="small" href="{{ route('password.request') }}">
                                        Forgot Password? Klik Here
                                    </a>
                                </div>
                             @endif
                        </form>
                        
                   
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
