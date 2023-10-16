@extends('wonderful.layouts.master')

@section('title')
  Admin | Create Data Transaksi
@endsection

@section('css')

@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Tambah Data Transaksi Baru</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('transaksi_masuk.index') }}">Data Transaksi Masuk</a></li>
            <li class="breadcrumb-item active">Create Data Transaksi</li>
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
            <h3 class="card-title">Masukan Data Transaksi</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post" action="{{ route('transaksi_masuk.store') }}">
            {{ csrf_field() }}
            <div class="card-body">

              <div class="form-group row {{ $errors->has('nama_produk') ? 'has-error' : '' }}">
                <label for="kd_produk" class="col-sm-2 control-label">Produk</label>
                <div class="col-sm-10">
                  <select name="kd_produk" id="kd_produk" class="form-control" required>
                    <option value="">Pilih Produk :</option>
                    @foreach($produk as $row)
                      <option value="{{ $row->kd_produk }}">{{ $row->nama_produk }}</option>
                    @endforeach
                  </select>
                  @if (@$errors->has('nama_produk'))
                   <span class="help-block">{{$errors->first('nama_produk')}}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row {{ $errors->has('nama_supplier') ? 'has-error' : '' }}">
                <label for="kd_supplier" class="col-sm-2 control-label">Supplier</label>
                <div class="col-sm-10">
                  <select name="kd_supplier" id="kd_supplier" class="form-control" required>
                    <option value="">Pilih Supplier :</option>
                    @foreach($supplier as $row)
                      <option value="{{ $row->kd_supplier }}">{{ $row->nama_supplier }}</option>
                    @endforeach
                  </select>
                  @if (@$errors->has('nama_supplier'))
                   <span class="help-block">{{$errors->first('nama_supplier')}}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row {{ $errors->has('tgl_transaksi') ? 'has-error' : '' }}">
                <label for="tgl_transaksi" class="col-sm-2 control-label">Tanggal Transaksi</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control datepicker" name="tgl_transaksi" id="tgl_transaksi" value="{{ old('tgl_transaksi') }}" readonly  required>
                  @if (@$errors->has('tgl_transaksi'))
                   <span class="help-block">{{$errors->first('tgl_transaksi')}}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" required>
                  @if (@$errors->has('jumlah'))
                   <span class="help-block">{{$errors->first('jumlah')}}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row {{ $errors->has('harga') ? 'has-error' : '' }}">
                <label for="harga" class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga') }}" required >
                  @if (@$errors->has('harga'))
                   <span class="help-block">{{$errors->first('harga')}}</span>
                  @endif
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
            </div>
            <!-- /.card-footer -->
          </form>
         </div>
       </div>
     </div>
   </section>
@endsection
