@extends('wonderful.layouts.master')

@section('title')
  Admin | Create User New
@endsection

@section('css')

@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Tambah Data User Baru</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Data Users</a></li>
            <li class="breadcrumb-item active">Create User Baru</li>
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
                <h3 class="card-title">Masukan Data User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal"  method="post" autocomplete="off" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-sm-2 col-form-label">Nama Panjang</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="name" placeholder="Nama Panjang" value="{{ old('name') }}" required>
                      @if (@$errors->has('name'))
                       <span class="help-block">{{$errors->first('name')}}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ old('username') }}" required>
                      @if (@$errors->has('username'))
                       <span class="help-block">{{$errors->first('username')}}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                        @if (@$errors->has('email'))
                         <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                      </div>
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
                  <div class="form-group row {{ $errors->has('level') ? 'has-error' : '' }}">
                    <label for="level" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <select name="level" id="level" class="form-control" required>
                        <option value="">Pilih Level User :</option>
                        <option value="admin">Administrator</option>
                        <option value="customer">Customer</option>
                        <option value="staff">Staff</option>
                      </select>
                      @if (@$errors->has('level'))
                       <span class="help-block">{{$errors->first('level')}}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Create</button>
                  <a href="{{ route('user.index') }}" type="submit" class="btn btn-default float-right">Cancel</a>
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
