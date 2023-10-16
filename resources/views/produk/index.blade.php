@extends('layouts.template')

@section('title')
Data Produk
@endsection

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endsection

@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

            @if(Request::get('keyword'))
              <a class="btn btn-success" href="{{ route('produk.index') }}">Back</a>
            @else
              <a class="btn btn-sm btn-success" href="{{ route('produk.create') }}"><span class="glyphicon glyphicon-plus"></span>Create</a>
            @endif
              <a class="btn btn-sm btn-primary" href="{{ route('produk.bulk') }}"><span class=""></span>Upload Data</a>
              {{-- <form method="get" action="{{route('produk.index')}}">
                  <div class="form-group">
                    <label for="keyword" class="col-sm-2 control-label">Search By Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                    </div>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                  </div>
                </form>
                <br><br>
                <form method="get" action="{{route('produk.index')}}">
                    <div class="form-group">
                      <label for="kd_kategori" class="col-sm-2 control-label">Search By Kategori</label>
                      <div class="col-sm-4">
                        <select class="form-control" name="kd_kategori" id="kd_kategori">
                          @foreach ($kategori as $row)
                            <option value="{{$row->kd_kategori}}">{{ $row->kategori }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                      </div>
                    </div>
                  </form> --}}

            </div>
            <div class="box-body">
              @if (Request::get('keyword'))
                <div class="alert alert-success alert-block">
                  Hasil Pencarian Produk dengan Keyword : <b>{{ Request::get('keyword') }}</b>
                </div>
              @endif

              @if (Request::get('kd_kategori1'))
                <div class="alert alert-success alert-block">
                  Hasil Pencarian Produk dengan Kategori : <b>{{ Request::get('nama_kategori') }}</b>
                </div>
              @endif

              @include('alert.succes')
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Nama Kategori</th>
                            <th>Kode Sale</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>Gambar</th>
                            <th>Stok</th>
                            <th width="30%">Action</th>
                        </tr>
                   </thead>
                   <tbody>
                       @foreach($produk as $row)
                       <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nama_produk }}</td>
                            <td>{{ $row->kategori->kategori }}</td>
                            <td>{{ $row->kode }}</td>
                            <td>@rupiah($row->harga)</td>
                            <td>{{ $row->ket }}</td>
                            <td> <img class="img-thumbnail" width="100px" src="{{ asset('uploads/'.$row->gambar_produk) }}" alt=""> </td>
                            <td>{{ $row->stok }}</td>
                            <td>
                              <form class="" action="{{ route('produk.destroy',[$row->kd_produk]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                                @csrf
                                {{ method_field('Delete') }}
                                <a class="btn btn-warning "clas="btn btn-warning" href="{{ route('produk.edit',[$row->kd_produk]) }}">Edit</a>
                                <a class="btn btn-primary "clas="btn btn-warning" href="">Show</a>
                                <button type="submit" name="button" class="btn btn-danger">Delete</button>
                              </form>
                            </td>
                       </tr>
                       @endforeach
                   </tbody>
                </table>

            </div>
          </div>
        </div>
</div>
@endsection

@section('script')
  <!-- DataTables -->
  <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script type="text/javascript">
      $(function () {
        $('#example1').DataTable()

  })
  </script>

@endsection
