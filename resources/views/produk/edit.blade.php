@extends('layouts.template')
@section('title')
  Update Data Produk
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" action="{{ route('produk.update',[$produk->kd_produk]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box-body">
                  <div class="form-group">
                    <label for="nama_produk" class="col-sm-2 control-label">Nama Produk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kd_kategori" class="col-sm-2 control-label">Kategori Produk</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="kd_kategori" id="kd_kategori">
                          @foreach ($kategori as $row)
                            <option value="{{ $row->kd_kategori }}" @if ($produk->kd_kategori == $row->kd_kategori)
                              Selected
                            @endif >{{ $row->kategori }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kode" class="col-sm-2 control-label">Kode Sale</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="kode" name="kode" value="{{ $produk->kode }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="harga" class="col-sm-2 control-label">Harga</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="weight" class="col-sm-2 control-label">Berat Tas</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="weight" name="weight" value="{{ $produk->weight }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="ket" class="col-sm-2 control-label">Harga</label>
                    <div class="col-sm-10">
                      <textarea type="text" class="form-control" id="ket" name="ket" rows="8" cols="80" value="">{{ $produk->ket }}</textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gambar_produk" class="col-sm-2 control-label">Gambar Produk</label>
                    <div class="col-sm-10">
                      <img class="img-thumbnail" width="100px" src="{{ asset('uploads/'.$produk->gambar_produk) }}" alt="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gambar_produk" class="col-sm-2 control-label">Gambar Produk</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" value="">
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" name="tombol" class="btn btn-info pull-right">Update</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>
</div>
@endsection
