@extends('admin.layouts.main')
@section('title', 'Dashboard')
@section('menu-dashboard', 'active')
@section('content')
    <div class="container-fluid">
        @if (Auth::user()->level == 'admin' ||
            Auth::user()->level == 'admintembiring' ||
            Auth::user()->level == 'adminkadilangu')
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong> Welcome <b>{{ Auth::user()->name }}</b> di Portal Web Parkir Kab.
                    Demak !</strong>
            </div>
        @else
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong> Welcome <b>{{ Auth::user()->name }}</b> Portal Web Parkir App !</strong>
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
                    <div id="grafik">

                    </div>
                    <hr>
                    <div id="grafik-alluser"></div>
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
        let pendapatan2 = <?php echo json_encode($data2); ?>;
        let namauser = <?php echo json_encode($namauser); ?>;
        let bulan = <?php echo json_encode($bulan); ?>;
        let incometahun = <?php echo json_encode($total_income); ?>;
        // convert bilangan
        let reverse = incometahun.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');


        Highcharts.chart('grafik', {
            title: {
                text: 'Grafik Pendapatan Bulanan All Parkir'
            },
            xAxis: {
                categories: bulan
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
                    data: pendapatan

                },
                {
                    name: 'Total Tahunan : Rp.' + ribuan
                }
            ]

        });
        // count per user
        // Highcharts.chart('grafik-alluser', {
        //     chart: {
        //         type: 'column'
        //     },
        //     title: {
        //         text: 'grafik Pendapatan Bulanan /User Pos Jaga'
        //     },
        //     subtitle: {
        //         text: '-'
        //     },
        //     xAxis: {
        //         categories:bulan
        //     },
           
        //     tooltip: {
        //         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        //         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        //             '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        //         footerFormat: '</table>',
        //         shared: true,
        //         useHTML: true
        //     },
        //     plotOptions: {
        //         column: {
        //             pointPadding: 0.2,
        //             borderWidth: 0
        //         }
        //     },
        //     series: [{
        //         name: 'Tokyo',
        //         data: pendapatan2

        //     }, {
        //         name: 'New York',
        //         data: [83.6
        //         ]

        //     }, {
        //         name: 'London',
        //         data: [48.9
        //         ]

        //     }, {
        //         name: 'Berlin',
        //         data: [42.4
        //         ]

        //     }]
        // });
    </script>
    <!-- End Script Hight Chart Js -->
    // script basic colum js
   
@endpush
