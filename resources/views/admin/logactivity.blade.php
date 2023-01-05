@extends('admin.layouts.main')
@section('title', 'Log Activity')
@section('log-activity', 'active')
@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>IP Adress</th>
                            <th>Jenis Browser</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @if($logs->count())
                            @foreach ($logs as $key => $log)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$log->user}}</td>
                                    <td>{{$log->subject}}</td>
                                    <td class="text-warning">{{$log->ip}}</td>
                                    <td class="text-danger">{{$log->agent}}</td>
                                    <td>{{$log->created_at}}</td>
                                </tr>
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

