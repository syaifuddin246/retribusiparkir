@extends('admin.layouts.main')
@section('title', 'Retribusi Wisata')
@section('parkir-in', 'active')
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
                        <h6 class="m-0 font-weight-bold text-primary">List Retribusi Wisata</h6>
                    </div>
                    <div class="col-md-8">
                        <a href="{{ url('/admin/parkir_in/create') }}" class="btn btn-primary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-plus"></i></a>
                        <a href="{{ url('/dashboard') }}" class="btn btn-secondary btn-sm"
                            style="float: right; margin-left:2px;"><i class="fa fa-home"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        
                        <thead style="text-align: center">
                            <tr>
                                <th scope="col">No</th>
                                @if (Auth::user()->level == 'master')
                                    <th scope="col">Petugas</th>
                                @endif
                                <th scope="col">Hari & Tanggal</th>
                                
                                {{-- <th scope="col">Plat Kendaraan</th> --}}
                                {{-- <th scope="col">Image Bus</th> --}}
                                <th scope="col">Type Kendaraan</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Porporasi Pengunjung</th>
                                <th scope="col">Porporasi Kebersihan</th>
                                <th scope="col">Asal Rombongan</th>
                                {{-- <th scope="col">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @if($data->count())
                            @foreach ($data as $key => $row)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    @if (Auth::user()->level == 'master')
                                        <td>{{ $row->user->name }}</td>
                                    @endif
                                    <td>{{ $row->updated_at->isoFormat('dddd, D/M/Y, H:mm:ss') }}</td>
                                    {{-- @if ($row->plat != null)
                                    <td>{{ $row->plat }}</td>
                                    @else
                                    <td>-</td>
                                    @endif --}}
                                    {{-- <td><img src="{{ asset('storage/content/parkir_img/' . $row->image) }}" width="100px"
                          height="80px"></td> --}}
                                    <td>{{ $row->kategori->items }}</td>
                                    <td>Rp.{{ number_format($row->total), 2, '.', '.' }}</td>
                                    <td>{{$row->porporasi}}</td>
                                    <td>{{$row->porporasi_kebersihan}}</td>
                                    <td>{{$row->rombongan}}</td>
                                    {{-- <td>
                                        <div class="btn-group" role="group" aria-label="Basic-example">
                                            <a href="/admin/parkir_in/{{ $row->id }}" target="_blank"
                                                class="btn btn-info btn-sm mr-1"><i class="fas fa-print"></i> Cetak</a>
                                           

                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{-- <div>
                    Showing
                    {{ $data->firstItem() }}
                    of
                    {{ $data->lastItem() }}
                </div>
                <div class="pagination justify-content-end">
                    {{ $data->links() }}
                </div> --}}

            </div>
        </div>

    </div>


@endsection
@push('js')

@endpush
