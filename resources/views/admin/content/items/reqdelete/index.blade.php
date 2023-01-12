@extends('admin.layouts.main')
@section('title', 'Request Delete')
@section('content-menu', 'show')
@section('req-delete', 'active')
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
                        <h6 class="m-0 font-weight-bold text-primary">List Request Delete Data</h6>
                    </div>
                    
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ALL DATA</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">DATA TEMBIRING</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">DATA KADILANGU</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
        
                                <thead style="text-align: center">
                                    <tr>
                                        @if (Auth::user()->level == 'master')
                                            <th scope="col">Petugas</th>
                                        @endif
                                        <th scope="col">Hari & Tanggal</th>
                                        <th scope="col">Plat Kendaraan</th>
                                        {{-- <th scope="col">Image Bus</th> --}}
                                        <th scope="col">Type Kendaraan</th>
                                        <th scope="col">Total Bayar</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    @foreach ($data as $key => $row)
                                        <tr>
                                            @if (Auth::user()->level == 'master')
                                                <td>{{ $row->user->name }}</td>
                                            @endif
                                            <td>{{ $row->updated_at->isoFormat('dddd, D/M/Y, H:mm:ss') }}</td>
                                            <td>{{ $row->plat }}</td>
                                            {{-- <td><img src="{{ asset('storage/content/parkir_img/' . $row->image) }}" width="100px"
                                  height="80px"></td> --}}
                                            <td>{{ $row->kategori->items }}</td>
                                            <td>Rp.{{ number_format($row->total), 2, '.', '.' }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic-example">
                                                    
                                                    @if (Auth::user()->level == 'master')
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModal{{ $row->id }}"
                                                            class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>
                                                            Delete</a>
                                                        <!-- Modal delete-->
                                                        <form action="/admin/parkir_in/{{ $row->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal fade" id="exampleModal{{ $row->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                                Data ?
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p class="text-left">Yakin Ingin Menghapus
                                                                                Data
                                                                                Ini ? <br> Pastikan Di Sumber Asal Data Sudah Terhapus</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
        
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
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
        
                                <thead style="text-align: center">
                                    <tr>
                                        @if (Auth::user()->level == 'master')
                                            <th scope="col">Petugas</th>
                                        @endif
                                        <th scope="col">Hari & Tanggal</th>
                                        <th scope="col">Plat Kendaraan</th>
                                        {{-- <th scope="col">Image Bus</th> --}}
                                        <th scope="col">Type Kendaraan</th>
                                        <th scope="col">Total Bayar</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    @foreach ($data2 as $key => $row)
                                        <tr>
                                            @if (Auth::user()->level == 'master')
                                                <td>{{ $row->user->name }}</td>
                                            @endif
                                            <td>{{ $row->updated_at->isoFormat('dddd, D/M/Y, H:mm:ss') }}</td>
                                            <td>{{ $row->plat }}</td>
                                            {{-- <td><img src="{{ asset('storage/content/parkir_img/' . $row->image) }}" width="100px"
                                  height="80px"></td> --}}
                                            <td>{{ $row->kategori->items }}</td>
                                            <td>Rp.{{ number_format($row->total), 2, '.', '.' }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic-example">
                                                    @if (Auth::user()->level == 'master')
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModal{{ $row->id }}"
                                                            class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>
                                                            Delete</a>
                                                        <!-- Modal delete-->
                                                        <form action="/admin/parkir_in/{{ $row->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal fade" id="exampleModal{{ $row->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                                Data ?
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p class="text-left">Yakin Ingin Menghapus
                                                                                Data
                                                                                Ini ? <br> Apabila Ya, Pastikan di (All Data) Data Sudah Terhapus !</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
        
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            Showing
                            {{ $data2->firstItem() }}
                            of
                            {{ $data2->lastItem() }}
                        </div>
                        <div class="pagination justify-content-end">
                            {{ $data2->links() }}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
        
                                <thead style="text-align: center">
                                    <tr>
                                        @if (Auth::user()->level == 'master')
                                            <th scope="col">Petugas</th>
                                        @endif
                                        <th scope="col">Hari & Tanggal</th>
                                        <th scope="col">Plat Kendaraan</th>
                                        {{-- <th scope="col">Image Bus</th> --}}
                                        <th scope="col">Type Kendaraan</th>
                                        <th scope="col">Total Bayar</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center">
                                    @foreach ($data3 as $key => $row)
                                        <tr>
                                            @if (Auth::user()->level == 'master')
                                                <td>{{ $row->user->name }}</td>
                                            @endif
                                            <td>{{ $row->updated_at->isoFormat('dddd, D/M/Y, H:mm:ss') }}</td>
                                            <td>{{ $row->plat }}</td>
                                            {{-- <td><img src="{{ asset('storage/content/parkir_img/' . $row->image) }}" width="100px"
                                  height="80px"></td> --}}
                                            <td>{{ $row->kategori->items }}</td>
                                            <td>Rp.{{ number_format($row->total), 2, '.', '.' }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic-example">
                                                   
                                                    @if (Auth::user()->level == 'master')
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModal{{ $row->id }}"
                                                            class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i>
                                                            Delete</a>
                                                        <!-- Modal delete-->
                                                        <form action="/admin/parkir_in/{{ $row->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal fade" id="exampleModal{{ $row->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                                Data ?
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p class="text-left">Yakin Ingin Menghapus
                                                                                Data
                                                                                Ini ? <br> Apabila Ya, Pastikan di (All Data) Data Sudah Terhapus !</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
        
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            Showing
                            {{ $data3->firstItem() }}
                            of
                            {{ $data3->lastItem() }}
                        </div>
                        <div class="pagination justify-content-end">
                            {{ $data3->links() }}
                        </div>
                    </div>
                  </div>
              
            </div>
        </div>

    </div>


@endsection
@push('js')
@endpush
