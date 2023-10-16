@extends('wonderful.layouts.master')

@section('title')
  Admin | PEsanan Detail
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
          <h3>Data Pesanan</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">
                Detail pesanan
              </h4>
            </div>
            <div class="card-body">
              <div class="row">

                <!-- BLOCK UNTUK MENAMPILKAN DATA PELANGGAN -->
                <div class="col-md-6">
                  <h4>Detail Pelanggan</h4>
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">Nama Pelanggan</th>
                      <td>{{ $order->customer->name }}</td>
                    </tr>
                    <tr>
                      <th>Telp</th>
                      <td>{{ $order->customer->nohp }}</td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td>{{ $order->customer_address }} {{ $order->customer->district->name }} - {{  $order->customer->district->city->name}}, {{ $order->customer->district->city->province->name }}</td>
                    </tr>
                    <tr>
                      <th>Order Status</th>
                      <td>{!! $order->status_label !!}</td>
                    </tr>
                    <!-- FORM INPUT RESI HANYA AKAN TAMPIL JIKA STATUS LEBIH BESAR 1 -->
                    @if ($order->status > 1)
                      <tr>
                        <th>Nomor Resi</th>
                        <td>
                          @if ($order->status == 2)
                            <form action="{{ route('orders.shipping') }}" method="post">
                              @csrf
                              <div class="input-group">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="text" name="tracking_number" placeholder="Masukkan Nomor Resi" class="form-control" required>
                                <div class="input-group-append">
                                  <button class="btn btn-secondary" type="submit">Kirim</button>
                                </div>
                              </div>
                            </form>
                          @else
                            {{ $order->tracking_number }}
                          @endif
                        </td>
                      </tr>
                    @endif
                  </table>
                </div>
                <div class="col-md-6">
                  <h4>Detail Pembayaran</h4>
                  @if ($order->status != 0)
                    <table class="table table-bordered">
                      <tr>
                        <th width="30%">Nama Pengirim</th>
                        <td>{{ $order->payment->name }}</td>
                      </tr>
                      <tr>
                        <th>Bank Tujuan</th>
                        <td>{{ $order->payment->transfer_to }}</td>
                      </tr>
                      <tr>
                        <th>Tanggal Transfer</th>
                        <td>{{ $order->payment->transfer_date }}</td>
                      </tr>
                      <tr>
                        <th>Bukti Pembayaran</th>
                        <td><a class="btn btn-sm btn-outline-info" target="_blank" href="{{ asset('uploads/customer/payment/' . $order->payment->proof) }}"><i class="fas fa-eye mr-1"></i>  Lihat</a></td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>{!! $order->payment->status_label !!}</td>
                      </tr>
                    </table>
                  @else
                    <h5 class="text-center mt-5">Belum Konfirmasi Pembayaran</h5>
                  @endif
                </div>
                <div class="col-md-12">
                  <h4>Detail Produk</h4>
                  <table class="table table-borderd table-hover">
                    <tr>
                      <th>Produk</th>
                      <th>Quantity</th>
                      <th>Harga</th>
                      <th>Berat</th>
                      <th>Subtotal</th>
                    </tr>
                    @foreach ($order->details as $row)
                      <tr>
                        <td>{{ $row->produk->nama_produk}}</td>
                        <td>{{ $row->qty }}</td>
                        <td>@rupiah($row->price)</td>
                        <td>{{ $row->weight }} gr</td>
                        <td>Rp {{ $row->qty * $row->price }}</td>
                      </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <!-- TOMBOL UNTUK MENERIMA PEMBAYARAN -->
              <div class="float-right">
                <!-- TOMBOL INI HANYA TAMPIL JIKA STATUSNYA 1 DARI ORDER DAN 0 DARI PEMBAYARAN -->
                @if ($order->status == 1 && $order->payment->status == 0)
                  <a href="{{ route('orders.approve_payment', $order->invoice) }}" class="btn btn-outline-primary btn-sm">Terima Pembayaran</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section >


@endsection

@section('script')
    <!--` DataTables -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
      $(function(){
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
        });
      });
    </script>`

@endsection
