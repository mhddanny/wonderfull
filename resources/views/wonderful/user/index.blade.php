@extends('wonderful.layouts.master')

@section('title')
  Admin | Users
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
          <h3>Data Users</h3>
          <div class="right">
            @if(Request::get('keyword'))
              <a class="btn btn-sm btn-outline-success" href="{{ route('user.index') }}">Back</a>
            @else
              <a class="btn btn-sm btn-outline-success" href="{{ route('user.create') }}"><span class="glyphicon glyphicon-plus"></span>Create</a>
            @endif
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
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
              <h3 class="card-title">Data Table Users</h3>
            </div>
            <div class="card-body">
              @include('alert.succes')
              <table table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th width="5%">No</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Level</th>
                          <th width="30%">Action</th>
                      </tr>
                 </thead>
                 <tbody>
                     @foreach($user as $row)
                     <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->username }}</td>
                          <td>{{ $row->email }}</td>
                          <td>{{ $row->level }}</td>
                          <td>

                            <form class="" action="{{ route('user.destroy',[$row->id]) }}" method="post"
                              onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                              @csrf
                              {{ method_field('Delete') }}
                              <a class="btn btn-sm btn-outline-warning" href="{{ route('user.edit',[$row->id]) }}"><i class="fas fa-edit"></i> Edit</a>
                              <a class="btn btn-sm btn-outline-info" href="{{ route('user.show',[$row->id]) }}"><i class="fas fa-eye"></i> Detail</a>
                              <button type="submit" name="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
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
