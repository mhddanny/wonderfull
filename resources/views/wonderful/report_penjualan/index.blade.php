@extends('wonderful.layouts.master')

@section('title')
  Admin | Data Report Penjualan
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
          <h3>Data Report Penjualan</h3>
          <div class="right">
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Report Penjualan</li>
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
            <div class="card-header with-border">
              <a target="_blank" href="{{ route('cetak_pdf') }}" class="btn btn-sm btn-outline-danger"><i class="fas fa-file-pdf mr-1"></i> PDF</a>
              <a target="_blank" href="{{ route('cetak_excel') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-file-excel mr-1"></i>  EXCEL</a>
            </div>
            <div class="card-body">
              @include('alert.succes')
              <table table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th with="5%">NO</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Agen</th>
                  </tr>
                  <tbody>
                    @foreach ($penjualan as $row)
                      <tr>
                        <td>{{ $loop->iteration + ($penjualan->perPage() * ($penjualan->currentPage() - 1 )) }}</td>
                        <td>{{ $row->produk->nama_produk }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>@rupiah($row->harga)</td>
                        <td>{{ $row->transaksi->tgl_penjualan }}</td>
                        <td>{{ $row->transaksi->agen->nama_toko }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Data Report Penjualan Dari Customer</h3>
          <div class="right">
          </div>
        </div>
        <div class="col-sm-6">

      </div>
    </div><!-- /.container-fluid -->
  </section>

  {{-- <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header with-border">
              <a target="_blank" href="{{ route('cetak_pdf') }}" class="btn btn-sm btn-outline-danger"><i class="fas fa-file-pdf mr-1"></i> PDF</a>
              <a target="_blank" href="{{ route('cetak_excel') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-file-excel mr-1"></i>  EXCEL</a>
            </div>
            <div class="card-body">
              @include('alert.succes')
              <table table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>InvoiceID</th>
                    <th>Pelanggan</th>
                    <th>Subtotal</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($orders as $row)
                    <tr>
                      <td><strong>{{ $row->invoice }}</strong></td>
                      <td>
                        <strong>{{ $row->customer_name }}</strong><br>
                        <label><strong>Telp:</strong> {{ $row->customer_phone }}</label><br>
                        <label><strong>Alamat:</strong> {{ $row->customer_address }} {{ $row->customer->district->name }} - {{  $row->customer->district->city->name}}, {{ $row->customer->district->city->province->name }}</label>
                      </td>
                      <td>Rp {{ number_format($row->subtotal) }}</td>
                      <td>{{ $row->created_at->format('d-m-Y') }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}

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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        //KETIKA PERTAMA KALI DI-LOAD MAKA TANGGAL NYA DI-SET TANGGAL SAA PERTAMA DAN TERAKHIR DARI BULAN SAAT INI
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            //KEMUDIAN TOMBOL EXPORT PDF DI-SET URLNYA BERDASARKAN TGL TERSEBUT
            $('#exportpdf').attr('href', '/administrator/reports/order/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            //INISIASI DATERANGEPICKER
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                //JIKA USER MENGUBAH VALUE, MANIPULASI LINK DARI EXPORT PDF
                $('#exportpdf').attr('href', '/administrator/reports/order/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
@endsection
