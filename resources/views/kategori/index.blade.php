@extends('layouts.template')

@section('title')
Data Kategori
@endsection
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@section('content')
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

            @if(Request::get('keyword'))
              <a class="btn btn-success" href="{{ route('kategori.index') }}">Back</a>
            @else
              <a class="btn btn-success" href="{{ route('kategori.create') }}"><span class="glyphicon glyphicon-plus"></span>Crete</a>
            @endif

              {{-- <form method="get" action="{{route('kategori.index')}}">
                  <div class="form-group">
                    <label for="keyword" class="col-sm-2 control-label">Search By Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                    </div>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                  </div>
                </form> --}}
            </div>
            <div class="box-body">
              {{-- @if (Request::get('keyword'))
                <div class="alert alert-success alert-block">
                  Hasil Pencarian Kategori dengan Keyword : <b>{{ Request::get('keyword') }}</b>
                </div>
              @endif --}}
              @if (session('success'))
                    @include('alert.succes')
              @endif
                     <!-- KETIKA ADA SESSION ERROR  -->
              @if (session('error'))
                  @include('alert.error1')
              @endif

                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            <th>Parent</th>
                            <th>Created At</th>
                            <th>Gambar kategori</th>
                            <th width="30%">Action</th>
                        </tr>
                   </thead>
                   <tbody>
                       @foreach($kategori as $row)
                       <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->kategori }}</td>
                            <td>{{ !$row->parent ? $row->parent_id : '-' }}</td>
                            <td>{{ $row->created_at->format('d-M-Y')}}</td>
                            <td><img class="img_thumbnail" src="{{ asset('uploads/'.$row->gambar_kategori) }}" width="100px"> </td>
                            <td>
                              <form class="" action="{{ route('kategori.destroy',[$row->kd_kategori]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                                @csrf
                                {{ method_field('Delete') }}
                                <a class="btn btn-sm btn-warning "clas="btn btn-warning" href="{{ route('kategori.edit',[$row->kd_kategori]) }}">Edit</a>
                                <button type="submit" name="button" class="btn btn-sm btn-danger">Delete</button>
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
  
