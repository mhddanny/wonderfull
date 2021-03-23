@extends('wonderful.layouts.master')

@section('title')
  Admin | Data Pesanan
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
          <h3>Data Order Customer</h3>
          <div class="right">
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
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

              <!-- FORM UNTUK FILTER DAN PENCARIAN -->
              <form action="{{ route('orders.index') }}" method="get">
                <div class="input-group mb-3 col-md-6 float-left">
                  <select name="status" class="form-control mr-3">
                    <option value="">Pilih Status</option>
                    <option value="0">Baru</option>
                    <option value="1">Confirm</option>
                    <option value="2">Proses</option>
                    <option value="3">Dikirim</option>
                    <option value="4">Selesai</option>
                  </select>
                  <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q }}">
                  <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                  </div>
                </div>
              </form>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>InvoiceID</th>
                      <th>Pelanggan</th>
                      <th>Subtotal</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($orders as $row)
                      <tr>
                        <td><strong>{{ $row->invoice }}</strong></td>
                        <td>
                          <strong>{{ $row->customer->name }}</strong><br>
                          <label><strong>Telp:</strong> {{ $row->customer->nohp }}</label><br>
                          <label><strong>Alamat:</strong> {{ $row->customer_address }} {{ $row->customer->district->name }} - {{  $row->customer->district->city->name}}, {{ $row->customer->district->city->province->name }}</label>
                        </td>
                        <td>@rupiah($row->subtotal)</td>
                        <td>{{ $row->created_at->format('d-m-Y') }}</td>
                        <td>{!! $row->status_label !!}
                          @if ($row->return_count > 0)
                              <a class="btn btn-sm btn-outline-info mt-1" href="{{ route('orders.return', $row->invoice) }}">Permintaan Return</a>
                          @endif
                        </td>
                        <td>
                          <form action="{{ route('orders.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('orders.view', $row->invoice) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                          </form>
                        </td>
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
