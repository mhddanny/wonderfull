@extends('layouts.template')

@section('title')
Data Customer
@endsection

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      @if (session('sukses'))
        <div class="alert alert-success" role="alert">
          {{session('sukses')}}
        </div>
      @endif
      <div class="box">
        <div class="box-header with-border">

          @if(Request::get('keyword'))
            <a class="btn btn-success" href="{{ route('customer.index') }}">Back</a>
          @else
            <a class="btn btn-success" href="{{ route('customer.create') }}"><span class="glyphicon glyphicon-plus"></span>Crete</a>
          @endif

        </div>
        <div class="box-body">

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th with="5%">No</th>
                <th>Daftar</th>
                <th>Nama Panjang</th>
                <th>Alamat</th>
                <th>No KTP</th>
                <th>No HP</th>
                <th>Status</th>

                <th width="30%">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($customer as $row)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $row->created_at->format('D, d M Y') }}</td>
                  <td>{{ $row->nama_customer }}</td>
                  <td>{{ $row->alamat }}</td>
                  <td>{{ $row->ktp }}</td>
                  <td>{{ $row->no_hp }}</td>
                  <td>
                    @if ($row->is_aktif == 0)
                      <span class="label label-danger pull-center">Not Active</span>
                    @else
                      <span class="label label-success pull-center">Active</span>
                    @endif
                  </td>
                  <td>
                    <form class="" action="{{ route('customer.destroy',[$row->id]) }}" method="post"
                      onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                      @csrf
                      {{ method_field('Delete') }}
                      <a class="btn btn-warning btn-sm" href="{{ route('customer.edit',[$row->id]) }}">
                        <i class="fa fa-edit"></i> Edit
                      </a>
                      <button class="btn btn-danger btn-sm" type="submit" name="button">
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
