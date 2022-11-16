@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('menu-dashboard', 'active')
@section('content')
    <div class="container-fluid">
        @if (Auth::user()->level == 'admin')
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong> Welcome <b>{{Auth::user()->name}}</b> di Portal Web Parkir Kab.
                    Demak !</strong>
            </div>
        @else
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong> Welcome <b>{{Auth::user()->name}}</b> Portal Web Parkir App !</strong>
            </div>

        @endif

    </div>
@endsection
{{-- @push('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    @include('admin.layouts.chart-js.visitor')
@endpush --}}
