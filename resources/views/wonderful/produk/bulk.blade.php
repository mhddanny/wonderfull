@extends('wonderful.layouts.master')

@section('title')
  Admin | Upload Data Produk
@endsection

@section('css')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Tambah Data Produk</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Upload Data Produk</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header with-border">
              <h5>Iput Data Produk</h5>
              @include('alert.error')
              @include('alert.succes')
            </div>
            <form class="form-horizontal" method="post" action="{{ route('produk.saveBulk') }}" enctype="multipart/form-data">
              <div class="card-body">
                {{ csrf_field() }}
                <div class="card-body">

                  <div class="form-group{{$errors->has('kd_kategori') ? 'has-error' : ''}}">
                    <label for="kd_kategori" class="col-sm-2 control-label">Kategori Produk</label>
                      <select class="form-control" name="kd_kategori" id="kd_kategori" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $row)
                          <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                        @endforeach
                      </select>
                      @if (@$errors->has('kd_kategori'))
                       <span class="help-block">{{$errors->first('kd_kategori')}}</span>
                     @endif
                  </div>

                  {{-- <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">File Excel</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="file" name="file" value="{{ old('file') }}">
                    </div>
                  </div> --}}

                  <div class="form-group{{$errors->has('file') ? 'has-error' : ''}}">
                    <label for="exampleInputFile">File Excel</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file" required>
                        <label class="custom-file-label" for="exampleInputFile">Masukan File Excel</label>
                      </div>
                    </div>
                    @if (@$errors->has('file'))
                      <span class="help-block">{{$errors->first('file')}}</span>
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
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header with-border">
              <h5>Upload Via Marketplace</h5>
            </div>
            <form class="form-horizontal" method="post" action="{{ route('produk.marketplace') }}" enctype="multipart/form-data">
              <div class="card-body">
                {{ csrf_field() }}
                <div class="card-body">

                  <div class="form-group">
                    <label for="">Marketplace</label>
                        <select name="marketplace" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="shopee">Shopee</option>
                        </select>
                      <p class="text-danger">{{ $errors->first('marketplace') }}</p>
                  </div>
                  <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" name="username" class="form-control" required>
                      <p class="text-danger">{{ $errors->first('username') }}</p>
                  </div>

                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" name="tombol" class="btn btn-info pull-right">Jadwalkan</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')

    <script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
              $(function () {
                  $('#datetimepicker4').datetimepicker({
                      format: 'L'
                  });
              });
              $(document).ready(function () {
                bsCustomFileInput.init();
              });
    </script>

@endsection
