@extends('wonderful.layouts.master')

@section('title')
  Admin | Create Kategori
@endsection

@section('css')

@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Tambah Data Kategori</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Data Kategori</a></li>
            <li class="breadcrumb-item active">Create Kategori</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content-header">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">Masukan Data Kategori</h3>
          </div>
          <form class="form-horizontal" method="post" autocomplete="off" action="{{ route('kategori.update',$kategori->kd_kategori) }}" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="card-body">
              <div class="form-group{{ $errors->has('kategori') ? 'has-error' : '' }}">
                <label for="kategori" class="col-sm-2 control-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $kategori->kategori }}" required>
                @if (@$errors->has('kategori'))
                 <span class="help-block">{{$errors->first('kategori')}}</span>
                @endif
              </div>

              <div class="form-group{{$errors->has('kd_kategori') ? 'has-error' : ''}}">
                <label for="parent_id" class="col-sm-2 control-label">Kategori</label>
                <select name="parent_id" class="form-control">
                  <option value="">None</option>
                  @foreach ($parent as $row)
                    <option value="{{ $row->kd_kategori }}" {{ $kategori->parent_id == $row->kd_kategori ? 'selected':'' }}>{{ $row->kategori }}</option>
                  @endforeach
                </select>
                @if (@$errors->has('kd_kategori'))
                 <span class="help-block">{{$errors->first('kd_kategori')}}</span>
                @endif
              </div>

              <div class="form-group">
                <label for="gambar_kategori">Gambar Sebelum</label>
                <div class="col-sm-10">
                  <img class="img_thumbnail" src="{{ asset('uploads/'.$kategori->gambar_kategori) }}" alt="" width="100px">
                </div>
              </div>

              <div class="form-group{{$errors->has('gambar_kategori') ? 'has-error' : ''}}">
                <label for="exampleInputFile">Gambar kategori</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar_kategori">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
                @if (@$errors->has('gambar_kategori'))
                  <span class="help-block">{{$errors->first('gambar_kategori')}}</span>
                @endif
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
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
