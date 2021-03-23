@extends('wonderful.layouts.master')

@section('title')
  Admin | Create Pegawai Baru
@endsection

@section('css')

@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Tambah Data Pegawai Baru</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Data Pegawai</li>
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
                <h3 class="card-title">Masukan Data Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal"  method="post" autocomplete="off" action="{{ route('pegawai.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label for="username" class="col-sm-2 col-form-label">Nama Panjang</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control" id="username" placeholder="Nama Panjang" value="{{ old('username') }}" required>
                      @if (@$errors->has('username'))
                       <span class="help-block">{{$errors->first('username')}}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row{{ $errors->has('password') ? 'has-error' : '' }}">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" value="{{ old('password') }}" required>
                        @if (@$errors->has('password'))
                         <span class="help-block">{{$errors->first('password')}}</span>
                        @endif
                      </div>
                  </div>
                  <div class="form-group row {{ $errors->has('nama_pegawai') ? 'has-error' : '' }}">
                    <label for="nama_pegawai" class="col-sm-2 col-form-label">Nama Panjang</label>
                      <div class="col-sm-10">
                        <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai" placeholder="Nama Panjang" value="{{ old('nama_pegawai') }}" required>
                        @if (@$errors->has('nama_pegawai'))
                         <span class="help-block">{{$errors->first('nama_pegawai')}}</span>
                        @endif
                      </div>
                  </div>
                  <div class="form-group row {{ $errors->has('jk') ? 'has-error' : '' }}">
                    <label for="jk" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <select name="jk" id="jk" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin :</option>
                          <option value="PRIA">Pria</option>
                          <option value="WANITA">Wanita</option>
                      </select>
                      @if (@$errors->has('jk'))
                       <span class="help-block">{{$errors->first('jk')}}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row{{ $errors->has('alamat') ? 'has-error' : '' }}">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" id="alamat">{{ old('alamat') }}</textarea>
                        @if (@$errors->has('alamat'))
                         <span class="help-block">{{$errors->first('alamat')}}</span>
                        @endif
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="jk" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select name="is_aktif" id="is_aktif" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Create</button>
                    <a href="{{ route('pegawai.index') }}" type="submit" class="btn btn-default float-right">Cancel</a>
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
