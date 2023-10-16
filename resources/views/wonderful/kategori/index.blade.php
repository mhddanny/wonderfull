@extends('wonderful.layouts.master')

@section('title')
  Admin | Kategori
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
          <h3>Data Kategori</h3>
          <div class="right">
            @if(Request::get('keyword'))
              <a class="btn btn-sm btn-outline-success" href="{{ route('kategori.index') }}">Back</a>
            @else
              <a class="btn btn-sm btn-outline-success" href="{{ route('kategori.create') }}"><span class="glyphicon glyphicon-plus"></span>Create</a>
            @endif
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Kategori</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Table Kategori</h3>
            </div>
            <div class="card-body">
              @include('alert.succes')
              <table table id="example1" class="table table-bordered table-striped">
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
                              <a class="btn btn-sm btn-outline-warning " href="{{ route('kategori.edit',[$row->kd_kategori]) }}"> <i class="fas fa-edit"></i> Edit</a>
                              <button type="submit" name="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash">
                              </i> Delete</button>
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
    </div>
  </section>

@endsection
@section('script')
    <!-- DataTables -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
        });
    </script>
@endsection
