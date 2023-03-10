@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('menu-dashboard', 'active')
@section('content')
    <div class="container-fluid">
        @if (Auth::user()->level == 'admin' ||
            Auth::user()->level == 'admintembiring' ||
            Auth::user()->level == 'adminkadilangu')
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong> Welcome <b>{{ Auth::user()->name }}</b> di Portal Retribusi Wisata Kab.
                    Demak !</strong>
            </div>
        @else
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong> Welcome <b>{{ Auth::user()->name }}</b> Portal Retribusi Wisata Kab.
                    Demak ! !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                    <form id="demo-form2" action="{{ url('/dashboard') }}" method="GET" data-parsley-validate
                        class="form-horizontal form-label-left">
                        @csrf
                        <div class="row form-group">
                            <label for="tahun" class="control-label text-right">Pilih Tahun</label>
                            <div class="col-md-3">
                                <select id="tahun" name="tahun" class="form-control" required>
                                    <option value="{{ $th }}" selected hidden>{{ $th }}</option>
                                    @foreach ($th_income as $tahun)
                                        <option value="{{ $tahun->thn }}">{{ $tahun->thn }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-outline-primary">Ubah</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                        data-target="#allparkir" aria-expanded="true" aria-controls="collapseOne">
                                        Grafik All Retribusi Wisata /Tahun @foreach ($th_income as $tahun)
                                            {{ $tahun->thn }}
                                        @endforeach
                                    </button>
                                </h2>
                            </div>

                            <div id="allparkir" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body" id="grafik">

                                </div>
                            </div>
                        </div>
                        {{-- <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#tembiring" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Grafik Retribusi Parkir Tembiring /Tahun @foreach ($th_income as $tahun)
                                            {{ $tahun->thn }}
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="tembiring" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body" id="grafiktembiring">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#kadilangu" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Grafik Retribusi Parkir Kadilangu /Tahun @foreach ($th_income as $tahun)
                                            {{ $tahun->thn }}
                                        @endforeach
                                    </button>
                                </h2>
                            </div>
                            <div id="kadilangu" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body" id="grafikkadilangu">

                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div id="grafik">

                    </div>
                    <hr>
                    <div id="grafiktembiring">

                    </div>
                    <hr>
                    <div id="grafikkadilangu">

                    </div> --}}

                </div>
            </div>
        @endif

    </div>

@endsection
@push('js')
    <!-- Script Hight Chart Js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        let pendapatan = <?php echo json_encode($data); ?>;
        let pendapatantembiring = <?php echo json_encode($data2); ?>;
        let pendapatankadilangu = <?php echo json_encode($data3); ?>;
        let bulan = <?php echo json_encode($bulan); ?>;
        let bulan2 = <?php echo json_encode($bulan2); ?>;
        let bulan3 = <?php echo json_encode($bulan3); ?>;
        let incometahun = <?php echo json_encode($total_income); ?>;
        let incometahun2 = <?php echo json_encode($total_income2); ?>;
        let incometahun3 = <?php echo json_encode($total_income3); ?>;
        // convert bilangan
        let reverse = incometahun.toString().split('').reverse().join(''),
            total = reverse.match(/\d{1,3}/g);
        total = total.join('.').split('').reverse().join('');
        // toal tembiring
        let reverse2 = incometahun2.toString().split('').reverse().join(''),
            total2 = reverse2.match(/\d{1,3}/g);
        total2 = total2.join('.').split('').reverse().join('');
        // total kadilangu
        let reverse3 = incometahun3.toString().split('').reverse().join(''),
            total3 = reverse3.match(/\d{1,3}/g);
        total3 = total3.join('.').split('').reverse().join('');


        Highcharts.chart('grafik', {
            title: {
                text: 'Grafik Bulanan All Retribusi Wisata Demak '
            },
            xAxis: {
                categories: bulan
            },
            yAxis: {
                title: {
                    text: 'Nominal Bulanan'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                    name: 'Total',
                    colorByPoint: true,
                    data: pendapatan

                },
                {
                    name: 'Total Tahunan : Rp.' + total
                }
            ]

        });

        // tembiring
        Highcharts.chart('grafiktembiring', {
            title: {
                text: 'Grafik Pendapatan Bulanan Tembiring'
            },
            xAxis: {
                categories: bulan2
            },
            yAxis: {
                title: {
                    text: 'Nominal Pendapatan Bulanan'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                    name: 'Total',
                    colorByPoint: true,
                    data: pendapatantembiring

                },
                {
                    name: 'Total Tahunan : Rp.' + total2
                }
            ]

        });
        // end tembiring

        // kadilangu
        Highcharts.chart('grafikkadilangu', {
            title: {
                text: 'Grafik Pendapatan Bulanan Kadilangu'
            },
            xAxis: {
                categories: bulan3
            },
            yAxis: {
                title: {
                    text: 'Nominal Pendapatan Bulanan'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                    name: 'Total',
                    colorByPoint: true,
                    data: pendapatankadilangu

                },
                {
                    name: 'Total Tahunan : Rp.' + total3
                }
            ]

        });
        // end kadilangu
    </script>
    <!-- End Script Hight Chart Js -->
@endpush
