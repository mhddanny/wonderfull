@extends('layouts.template')
@section('title')
  upload Data
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" action="{{ route('produk.saveBulk') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">

                  <div class="form-group">
                    <label for="kd_kategori" class="col-sm-2 control-label">Kategori Produk</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="kd_kategori" id="kd_kategori">
                          @foreach ($kategori as $row)
                            <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="file" class="col-sm-2 control-label">File Excel</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="file" name="file" value="{{ old('file') }}">
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
