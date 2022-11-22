@extends('client/layouts/main')
@section('title','Parkir-App Dinas Pariwisata')
@section('content')
     <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="{{url('/')}}"><img src="" alt=""> </a></h1>
      {{-- <h1 class="logo"><a href="{{url('/')}}"><img src="{{asset('front/assets/img/logodemak.png')}}" alt=""> Parkir-App</a></h1> --}}
    
      <nav id="navbar" class="navbar">
        <ul>
        
          <li style="text-align-last: center;"><a class="btn-get-started scrollto" href="{{url('/login')}}">Admin Pos Jaga</a></li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container position-relative">
      <h1 class="text-home">Parkir-App</h1>
      <h2 class="text-home">Pemerintahan Kabupaten Demak - Dinas Pariwisata</h2>
    </div>
		{{-- <ul class="animation-area box-area">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul> --}}
  </section><!-- End Hero -->
  <marquee width="100%" height="24" style="background-color: antiquewhite"><b class="text-home"> Dinas Pariwisata Kab. Demak - Layanan Aduan System  Call : 08989997248 | Email : Support@gmail.com</b></marquee>
@endsection