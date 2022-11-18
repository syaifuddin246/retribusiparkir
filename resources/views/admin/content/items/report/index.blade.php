@extends('admin.layouts.main')
@section('title', 'Laporan')
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
                        <h6 class="m-0 font-weight-bold text-primary">List Parkir In</h6>
                    </div>
                    <div class="col-md-8">

                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-home"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                {{-- <table border="0" cellspacing="5" cellpadding="5" class="">
                    <tbody>
                        <tr>
                            <td>Minimum date:</td>
                            <td><input type="text" id="min" name="min" placeholder="--select date--"></td>
                        </tr>
                        <tr>
                            <td>Maximum date:</td>
                            <td><input type="text" id="max" name="max" placeholder="--select date--"></td>
                        </tr>
                    </tbody>
                </table> --}}
                <div class="my-2">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/admin/laporan" method="GET">
                                <div class="input-group mb-3">

                                    <input type="date" class="form-control" name="start_date">
                                    <input type="date" class="form-control" name="end_date">
                                    <button class="btn btn-outline-dark btn-sm" type="submit">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                </div>
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>

                            <th scope="col">Admin Pos</th>
                            <th scope="col">Hari & Tanggal</th>
                            <th scope="col">Plat Kendaraan</th>
                            <th scope="col">Type Kendaraan</th>
                            <th scope="col">Tarif Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $row)
                            <tr>

                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->updated_at->isoFormat('dddd, D/M/Y, hh:mm') }}</td>
                                <td>{{ $row->plat }}</td>
                                <td>{{ $row->kategori->items }}</td>
                                <td>Rp.{{ number_format($row->kategori->price), 2, '.', '.' }}</td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
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
        var minDate, maxDate;
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[1]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialisation
            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });


            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });
    </script>
@endpush
