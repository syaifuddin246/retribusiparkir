@extends('admin.layouts.main')
@section('title', 'Parkir In - Admin')
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
                        <h6 class="m-0 font-weight-bold text-primary">List Parkir In</h6>
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
                    <table class="table table-striped table-hover table-bordered">
                     
                      <thead style="text-align: center">
                        <tr>
                            @if (Auth::user()->level == 'master')
                            <th scope="col">Admin Pos</th>
                            @endif
                            <th scope="col">Hari & Tanggal</th>
                            <th scope="col">Plat Kendaraan</th>
                            <th scope="col">Type Kendaraan</th>
                            <th scope="col">Tarif Biaya</th>
                            <th scope="col">Aciton</th>
                        </tr>
                      </thead>
                      <tbody style="text-align: center">
                        @foreach ($data as $key => $row)
                        <tr>
                        @if (Auth::user()->level == 'master')
                        <td>{{$row->user->name}}</td>
                        @endif
                        <td>{{$row->updated_at->isoFormat('dddd, D/M/Y, hh:mm')}}</td>
                        <td>{{$row->plat}}</td>
                        <td>{{$row->kategori->items}}</td>
                        <td>Rp.{{number_format($row->kategori->price),2,'.','.'}}</td>
                        <td>
                          <div class="btn-group" role="group" aria-label="Basic-example">
                            <a href="/admin/parkir_in/{{$row->id}}" target="_blank" class="btn btn-info btn-sm mr-1"><i class="bi bi-eye"></i> Cetak</a>
                          </div>
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div>
                    Showing
                    {{ $data->firstItem() }}
                    of
                    {{ $data->lastItem() }}
                  </div>
                  <div class="pagination justify-content-end">
                    {{ $data->links() }}
                  </div>

            </div>
        </div>

    </div>


@endsection
@push('js')
@endpush
