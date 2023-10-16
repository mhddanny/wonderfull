@extends('wonderful.layouts.master')

@section('title')
  Admin | Transaksi Masuk
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
            @if( Request::get('start_date') != "" && Request::get('end_date') != "")
              <a class="btn btn-sm btn-outline-success"  href="{{ route('transaksi_masuk.index') }}">Back</a>
            @else
              <a class="btn btn-sm btn-outline-success"  href="{{ route('transaksi_masuk.create') }}"><span class="glyphicon glyphicon-plus"></span> Create</a>
            @endif
            <br/>
            <br/>

          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Transaksi</li>
          </ol>
        </div>
      </div>
        <form method="get" action="{{route('transaksi_masuk.index')}}">
          <div class="form-group">
          <label for="nama_produk" class="col-sm-2 control-label">Search By Date</label>
          <div class="row mb-3">
            <div class="col-sm-4">
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" readonly name="start_date" placeholder="Start Date" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" readonly name="end_date" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Finish Date"/>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            </div>
            <div class="col-sm-2">
            <button type="submit" class="btn btn-outline-info"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
        </form>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header with-border">
            </div>
            <div class="card-body">

              @if( Request::get('start_date') != "" && Request::get('end_date') != "")
                <div class="alert alert-success alert-block">
                  Hasil Pencarian Transaksi Masuk Dari Tanggal :  {{ $start_date }} s/d  {{$end_date}}
                </div>
              @endif

              @include('alert.succes')
              <table table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Produk</th>
                    <th>Supplier</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th width="30%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($transaksi_masuk as $row)
                    <tr>
                      <td>{{ $loop->iteration + ($transaksi_masuk->perpage() * ($transaksi_masuk->currentPage() -1 ) ) }}</td>
                      <td>{{ $row->produk->nama_produk }}</td>
                      <td>{{ $row->supplier->nama_supplier }}</td>
                      <td>{{ $row->tgl_transaksi }}</td>
                      <td>{{ $row->jumlah }}</td>
                      <td>@rupiah($row->harga)</td>
                      <td>
                        <form class="" action="{{ route('transaksi_masuk.destroy',[$row->kd_transaksi_masuk]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                          @csrf
                          {{ method_field('Delete') }}
                          <button type="submit" name="button" class="btn btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $transaksi_masuk->appends(Request::all())->links() }}
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
          $('#reservation').daterangepicker()
        });
    </script>
@endsection
