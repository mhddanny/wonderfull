@extends('wonderful.layouts.master')

@section('title')
  Admin | Detail Pesanan
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
          <h3>Detail Pesanan</h3>
          <div class="right">
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active"> View Order</li>
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
              <h3 class="card-title">Data Table Order</h3>
            </div>
            <div class="card-body">
              @include('alert.succes')
              <div class="row mb-2">
                <div class="col-md-6">
                  <table id="example1" class="table table-bordered table-striped">
                    <tr>
                      <th width="30%">Nama Pelanggan</th>
                      <td>{{ $order->customer_name }}</td>
                    </tr>
                    <tr>
                      <th>Telp</th>
                      <td>{{ $order->customer_nohp }}</td>
                      </tr>

                      <tr>
                      <th>Alasan Return</th>
                        <td>{{ $order->return->reason }}</td>
                      </tr>
                      <tr>
                        <th>Rekening Pengembalian Dana</th>
                        <td>{{ $order->return->refund_transfer }}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>{!! $order->return->status_label !!}</td>
                      </tr>
                  </table>
                <!-- BAGIAN PENTING HANYA PADA FORM DIBAWAH -->
                  @if ($order->return->status == 0)
                    <form action="{{ route('orders.approve_return') }}" onsubmit="return confirm('Kamu Yakin?');" method="post">
                  @csrf
                    <div class="input-group mb-3">
                      <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <select name="status" class="form-control" required>
                          <option value="">Pilih</option>
                          <option value="1">Terima</option>
                          <option value="2">Tolak</option>
                        </select>
                      <div class="input-group-prepend">
                        <button class="btn btn-primary btn-sm">Proses Return</button>
                      </div>
                    </div>
                    </form>
                    @endif
                </div>
                <div class="col-md-6">
                    <h4 class="text-center">Foto Barang Return</h4><br>
                    <img src="{{ asset('uploads/customer/complain/' . $order->return->photo) }}" class="img-responsive" height="270" alt="">
                </div>
               </div>
            </div>
              <!-- /.card-body -->
          </div>
            <!-- /.card -->
        </div>
          <!-- /.col -->
      </div>
        <!-- /.row -->
    </div>
      <!-- /.container-fluid -->
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
