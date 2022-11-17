@extends('admin.layouts.main')
@section('title', 'Kategori Items - Admin')
@section('content-menu', 'show')
@section('content-kategori-items', 'active')
@section('content')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-4">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data Kategori Items</h6>
                </div>
                <div class="col-md-8">
                    <a href="{{url("admin/kategori_items")}}" class="btn btn-secondary btn-sm" style="float: right; margin-left:2px;"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
           
                
            <div class="card">
                <form method="POST" action="/admin/kategori_items/{{$data->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <!-- Name Users -->
                    <div style="padding: 30px;">
                      <div class="row mb-3">
                          <div class="col-md-6">
                              <label for="items" style="padding: 5px;"><b>Nama Kategori Items</b></label>
                              <input id="items" type="text" class="form-control @error('items') is-invalid @enderror" name="items" value="{{ old('items') ? old('items') : $data->items }}" required autocomplete="items" required placeholder="Nama Kategori Items...">

                              @error('items')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="col-md-3">
                              <label for="price" style="padding: 5px;"><b>Biaya</b></label>
                              <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ? old('price') : $data->price }}" required autocomplete="price" required placeholder="...">

                              @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                          <div class="col-md-3" style="padding-top: 42px;">
                            <button type="submit" class="btn btn-primary w-80">
                                <i class="fa fa-save"></i><b> Save Data</b>
                            </button>
                          </div>
                         
                      </div>
            
                    </div>
                </form>
            </div>
               
              
        </div>
    </div>

</div>
@endsection