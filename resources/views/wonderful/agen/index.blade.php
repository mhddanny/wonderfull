@extends('wonderful.layouts.master')

@section('title')
  Admin | Data Agen
@endsection

@section('css')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('section')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Data Agen</h3>
          <div class="right">
              <a class="btn btn-sm btn-outline-success" href="{{ route('user.create') }}"><span class="glyphicon glyphicon-plus"></span>Create</a>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Agen</li>
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
                    <th with="5%">NO</th>
                    <th>Nama Toko</th>
                    <th>Nama Pemilik</th>
                    <th>Alamat</th>
                    <th>Lat</th>
                    <th>Long</th>
                    <th>Gambar Toko</th>
                  </tr>
                  <tbody>
                    @forelse ($agen as $row)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama_toko }}</td>
                        <td>{{ $row->nama_pemilik }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>{{ $row->latitude }}</td>
                        <td>{{ $row->longitude }}</td>
                        <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_toko) }}" width="100px"></td>
                      </tr>
                    @empty
                        <tr>
                          <td>Data Tidak Ada</td>
                        </tr>
                    @endforelse
                  </tbody>
                </thead>
              </table>
            </div>
          </div>
          <div id="map" style="width:100%; height:400px;"  class="">  </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('script')
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
  <script>
      var locations = <?php echo $hasil_lat_long; ?>;
      var map = L.map('map').setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 18);
      mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
      L.tileLayer(
        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; ' + mapLink + ' Contributors',
          maxZoom: 18,
        }).addTo(map);

        for (var i = 0; i < locations.length; i++) {
          marker = new L.marker([locations[i][1],locations[i][2]])
          .bindPopup(locations[i][0])
          .addTo(map);
        }

    </script>
@endsection
