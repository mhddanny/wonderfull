@extends('wonderful.layouts.master')

@section('title')
  Admin | Edit Suppiler New
@endsection

@section('css')

@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Edit Data Supplier</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Data Supplier</a></li>
            <li class="breadcrumb-item active">Edit Suppiler</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content-header">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Masukan Data Suppiler</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal"  method="post" autocomplete="off" action="{{ route('supplier.update',[$supplier->kd_supplier]) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="card-body">
                  <div class="form-group{{ $errors->has('nama_supplier') ? 'has-error' : '' }}">
                    <label for="nama_suppliers">Nama</label>
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>
                     @if (@$errors->has('nama_supplier'))
                      <span class="help-block">{{$errors->first('nama_supplier')}}</span>
                     @endif
                  </div>
                  <div class="form-group{{ $errors->has('alamat_supplier') ? 'has-error' : '' }}">
                    <label for="alamat_suppliers">Alamat</label>
                    <textarea class="form-control" name="alamat_supplier" id="alamat_supplier">{{ $supplier->alamat_supplier }}</textarea>
                     @if (@$errors->has('alamat_supplier'))
                      <span class="help-block">{{$errors->first('alamat_supplier')}}</span>
                     @endif
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
                  <a href="{{ route('supplier.index') }}" type="submit" class="btn btn-default float-right">Cancel</a>
                </div>

                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </section>
  @endsection
  @section('script')

  @endsection
