@extends('admin.layouts.main')
@if (Auth::user()->level == 'master')
@section('title', 'Laporan Pemkab Demak ')
@elseif(Auth::user()->level == 'admintembiring')
@section('title', 'Laporan Tembiring Jogo Indah ')
@elseif(Auth::user()->level =='admikadilangu')
@section('title', 'Laporan Kadilangu Jogo Indah ')
@else
                    
@endif
@section('Laporan', 'active')
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
                    <h6 class="m-0 font-weight-bold text-primary">Laporan  @if (Auth::user()->level == 'master')
                        Pemkab Demak
                    @elseif(Auth::user()->level == 'admintembiring')
                        Tembiring Jogo Indah
                    @elseif(Auth::user()->level =='admikadilangu')
                        Kadilangu Jogo Indah
                    @else
                    
                    @endif
                    </h6>
                    </div>
                    <div class="col-md-8">

                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-home"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="my-2">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <form action="/admin/laporan" method="GET">
                                <div class="input-group mb-3">

                                    <input type="date" class="form-control" id="start_date" name="start_date" value="start_date">
                                    <input type="date" class="form-control" id= "end_date" name="end_date" value="end_date">
                                    <button class="btn btn-outline-dark btn-sm" type="submit">Tampilkan</button>
                                </div>
                            </form> --}}
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCetak">
                                <i class="fa fa-print"></i>
                                Cetak Laporan
                            </button>
                            
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                </div>
                <table id="example" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>

                            <th scope="col">Petugas</th>
                            <th scope="col">Hari & Tanggal</th>
                            {{-- <th scope="col">Plat Kendaraan</th> --}}
                            <th scope="col">Type Kendaraan</th>
                            <th scope="col">Porporasi Pengunjung</th>
                            <th scope="col">Porporasi Kebersihan</th>
                            <th scope="col">Retribusi Pengunjung</th>
                            <th scope="col">Retribusi Kebersihan</th>
                            @if (Auth::user()->level == 'master')
                            <th scope="col">Level Pos Jaga</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data as $key => $row)
                            <tr>

                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->created_at->isoFormat('dddd, D/M/Y, hh:mm') }}</td>
                                {{-- <td>{{ $row->updated_at->isoFormat('D/M/Y, hh:mm') }}</td> --}}
                                {{-- <td>{{ $row->updated_at}}</td> --}}
                                {{-- @if ($row->plat != null)
                                <td>{{ $row->plat }}</td>
                                @else
                                <td>-</td>
                                @endif --}}
                                <td>{{ $row->kategori->items }}</td>
                                <td>{{ $row->porporasi }}</td>
                                <td>{{ $row->porporasi_kebersihan }}</td>
                                <td>{{ number_format($row->price), 2, '.', '.' }}</td>
                                <td>{{ number_format($row->price2), 2, '.', '.' }}</td>
                                @if (Auth::user()->level == 'master')
                                <td>{{ $row->user->level }}</td>
                                @endif

                            </tr>
                        @endforeach
                    <tfoot>
                        {{-- <tr>
                            <th colspan="4" style="text-align:right"></th>
                            <th></th>
                        </tr> --}}
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Total Pengunjung</th>
                            <th scope="col">Total Kebersihan</th>
                            @if (Auth::user()->level == 'master')
                            <th scope="col"></th>
                            @endif
                        </tr>
                    </tfoot>
                    </tbody>


                </table>
            </div>
        </div>
    </div>
    <!-- Modal Cetak -->
<div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('admin/laporan/cetak')}}" method="get" target="_blank" enctype="multipart/form-data">
                {{-- @csrf --}}
            <div class="modal-body">
                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" class="form-control" name="tgl_mulai" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" class="form-control" name="tgl_selesai" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-back"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Laporan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>

    {{-- script export --}}
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>


    <script>
      
            
        $(document).ready(function() {
          
            // DataTables initialisation
            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                buttons: [
            
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                  
                ],
                scrollX: true,
                responsive: true,


                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    
                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i ===
                            'number' ? i : 0;
                    };

                    // Total over this page
                    pageTotal = api
                        .column(5, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    // Total over this page
                    pageTotal2 = api
                        .column(6, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    // Total over this page
                 

                    // Update footer
                    // $(api.column(4).footer()).html('Total :' + pageTotal);
                    $(api.column(6).footer()).html('Total Kebersihan: ' + pageTotal2);
                    $(api.column(5).footer()).html('Total Pengunjung: ' + pageTotal);
            
                },
            });


            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });
    </script>
@endpush