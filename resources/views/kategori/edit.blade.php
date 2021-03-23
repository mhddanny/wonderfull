@extends('layouts.template')
@section('title')
  Update Data Kategori
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post" action="{{ route('kategori.update',$kategori->kd_kategori) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{method_field('PUT')}}
                <div class="box-body">
                  <div class="form-group">
                    <label for="kategori" class="col-sm-2 control-label">Nama Kategori</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $kategori->kategori }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="parent_id" class="col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-10">
                      <select name="parent_id" class="form-control">
                          <option value="">None</option>
                            @foreach ($parent as $row)
                              <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gambar_kategori" class="col-sm-2 control-label">Gambar</label>
                    <div class="col-sm-10">
                      <img class="img_thumbnail" src="{{ asset('uploads/'.$kategori->gambar_kategori) }}" alt="" width="100px">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gambar_kategori" class="col-sm-2 control-label">Gambar</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori" value="">
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
