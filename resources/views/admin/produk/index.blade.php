@extends('admin.layouts.master')

@section('title')
  Admin | Category
@endsection

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">


@endsection

@section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Data Produk</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Produk</li>
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
              <h3 class="card-title">Data Table Produk</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th width="5%">No</th>
                          <th>Nama Produk</th>
                          <th>Nama Kategori</th>
                          <th>Kode Sale</th>
                          <th>Harga</th>
                          <th>Keterangan</th>
                          <th>Gambar</th>
                          <th>Stok</th>
                          <th width="30%">Action</th>
                      </tr>
                 </thead>
                 <tbody>
                     @foreach($produk as $row)
                     <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $row->nama_produk }}</td>
                          <td>{{ $row->kategori->kategori }}</td>
                          <td>{{ $row->kode }}</td>
                          <td>@rupiah($row->harga)</td>
                          <td>{{ $row->ket }}</td>
                          <td> <img class="img-thumbnail" width="100px" src="{{ asset('uploads/'.$row->gambar_produk) }}" alt=""> </td>
                          <td>{{ $row->stok }}</td>
                          <td>
                            <form class="" action="{{ route('produk.destroy',[$row->kd_produk]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                              @csrf
                              {{ method_field('Delete') }}
                              <a class="btn btn-warning "clas="btn btn-warning" href="{{ route('produk.edit',[$row->kd_produk]) }}">Edit</a>
                              <a class="btn btn-primary "clas="btn btn-warning" href="">Show</a>
                              <button type="submit" name="button" class="btn btn-danger">Delete</button>
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
