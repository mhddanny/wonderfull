@extends('layouts.template')
@section('title')
  Tambah Data Customer
@endsection

@section('css')
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/all.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('customer.store') }}">
                  {{ csrf_field() }}
                    <div class="form-group {{$errors->has('nama_customer') ? 'has-error' : ''}}">
                      <label for="nama_customer" class="col-sm-2 control-label">Nama Customer</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ old('nama_customer') }}">
                        @if (@$errors->has('nama_customer'))
                          <span class="help-block">{{$errors->first('nama_customer')}}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                      <label for="username" class="col-sm-2 control-label">User Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                        @if (@$errors->has('username'))
                          <span class="help-block">{{$errors->first('username')}}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group {{$errors->has('ktp') ? 'has-error' : ''}}">
                      <label for="ktp" class="col-sm-2 control-label">No KTP</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" id="ktp" name="ktp" value="{{ old('ktp') }}">
                        @if (@$errors->has('ktp'))
                          <span class="help-block">{{$errors->first('ktp')}}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
                      <label for="no_hp" class="col-sm-2 control-label">No Hp</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                        @if (@$errors->has('no_hp'))
                          <span class="help-block">{{$errors->first('no_hp')}}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                      <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="alamat" id="alamat">{{ old('alamat') }}</textarea>
                        @if (@$errors->has('alamat'))
                          <span class="help-block">{{$errors->first('alamat') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @if (@$errors->has('email'))
                          <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                      <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="password" value="">
                          @if (@$errors->has('password'))
                            <span class="help-block">{{$errors->first('password')}}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="is_aktif" class="col-sm-2 control-label">Status</label>
                          <div class="col-sm-10">
                            <select name="is_aktif" id="is_aktif" class="form-control">
                              <option value="1">Aktif</option>
                              <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                      </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('script')
  <!-- InputMask -->
  <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset ('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
  <script type="text/javascript">
    $(function () {
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
    })
  </script>
@endsection
