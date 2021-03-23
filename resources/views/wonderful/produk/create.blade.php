@extends('wonderful.layouts.master')

@section('title')
  Admin | Create Produk
@endsection

@section('css')
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

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
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Data Produk</a></li>
            <li class="breadcrumb-item active">Create Produk</li>
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
            <h3 class="card-title">Masukan Data Produk</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" method="post" autocomplete="off" action="{{ route('produk.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group{{ $errors->has('nama_produk') ? 'has-error' : '' }}">
                <label for="nama_produks">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
                 @if (@$errors->has('nama_produk'))
                  <span class="help-block">{{$errors->first('nama_produk')}}</span>
                 @endif
              </div>
              <div class="form-group{{$errors->has('kd_kategori') ? 'has-error' : ''}}">
                <label for="kd_kategori">Kategori</label>
                <select class="form-control" name="kd_kategori" id="kd_kategori" required>
                    <option value="">Pilih Kategori :</option>
                    @foreach ($kategori as $row)
                      <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                    @endforeach
                </select>
                @if (@$errors->has('kd_kategori'))
                 <span class="help-block">{{$errors->first('kd_kategori')}}</span>
               @endif
              </div>
              <div class="form-group{{$errors->has('kode') ? 'has-error' : ''}}">
                <label for="kode">Kode Produk</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode') }}" required>
                @if (@$errors->has('kode'))
                 <span class="help-block">{{$errors->first('kode')}}</span>
                @endif
              </div>
              <div class="form-group{{$errors->has('weight') ? 'has-error' : ''}}">
                <label for="weight">Berat Produk</label>
                <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" required>
                @if (@$errors->has('weight'))
                 <span class="help-block">{{$errors->first('weight')}}</span>
                @endif
              </div>
              <div class="form-group{{$errors->has('harga') ? 'has-error' : ''}}">
                <label for="exampleInputEmail1">Harga</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
                @if (@$errors->has('harga'))
                  <span class="help-block">{{$errors->first('harga')}}</span>
                @endif
              </div>
              <div class="form-group{{$errors->has('ket') ? 'has-error' : ''}}">
                <label for="ket">Keterangan Produk</label>
                <textarea class="textarea" placeholder="Place some text here" name="ket"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                @if (@$errors->has('ket'))
                    <span class="help-block">{{$errors->first('ket')}}</span>
                @endif
              </div>
              <div class="form-group{{$errors->has('gambar_produk') ? 'has-error' : ''}}">
                <label for="exampleInputFile">Gambar Produl</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar_produk" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
                @if (@$errors->has('gambar_produk'))
                  <span class="help-block">{{$errors->first('gambar_produk')}}</span>
                @endif
              </div>
            </div>
            <!-- /.card-body -->

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
    <!-- CK Editor -->
    <script src="{{asset ('frontend/ckeditor5/ckeditor.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset ('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
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
    <script>
            ClassicEditor
                .create( document.querySelector( '#ket' ) )
                .catch( error => {
                    console.error( error );
                } );
    </script>

@endsection
