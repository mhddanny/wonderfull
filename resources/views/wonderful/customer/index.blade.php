@extends('wonderful.layouts.master')

@section('title')
  Admin | Customers
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
          <h3>Data Customer</h3>
          <div class="right">
            @if(Request::get('keyword'))
              <a class="btn btn-sm btn-outline-success" href="{{ route('customer.index') }}">Back</a>
            @else
              <a class="btn btn-sm btn-outline-success" href="{{ route('customer.create') }}"><span class="glyphicon glyphicon-plus"></span>Create</a>
            @endif
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Customer</li>
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
              <h3 class="card-title">Data Table Customers</h3>
            </div>
            <div class="card-body">
              @include('alert.succes')
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th width="15%">Daftar</th>
                  <th width="15%">Nama Panjang</th>
                  <th>Email</th>
                  <th>No KTP</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>Status</th>
                  <th width="30%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($customer as $row)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->created_at->format('D, d M Y') }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->ktp }}</td>
                    <td>{{ $row->nohp }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td>
                      @if ($row->is_aktif == 0)
                        <span class="badge bg-danger pull-center">Not Active</span>
                      @else
                        <span class="badge bg-success pull-center">Active</span>
                      @endif
                    </td>
                    <td>
                      <form class="" action="{{ route('customer.destroy',[$row->id]) }}" method="post"
                        onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                        @csrf
                        {{ method_field('Delete') }}
                        <a class="btn btn-outline-warning btn-sm" href="{{ route('customer.edit',[$row->id]) }}">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-outline-danger btn-sm" type="submit" name="button">
                          <i class="fa fa-trash"></i> Delete
                        </button>
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
