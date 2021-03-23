@extends('wonderful.layouts.master')

@section('title')
  Admin | Wonderful Collection
@endsection

@section('css')

@endsection

@section('section')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Home</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Home</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <h5 class="mb-2">Dashboard</h5>
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="ion ion-bag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">{{ $produk }}</span>
              </div>
                <!-- /.info-box-content -->
            </div>
              <!-- /.info-box -->
        </div>
            <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-list-outline"></i></span>

             <div class="info-box-content">
                  <span class="info-box-text">Agen</span>
                <span class="info-box-number">{{ $agen }}</span>
             </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
        </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Penjualan</span>
                <span class="info-box-number">{{ $transaksi }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-cash"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pendapatan</span>
                <span class="info-box-number">@rupiah($pendapatan)</span>
            </div>
                <!-- /.info-box-content -->
          </div>
              <!-- /.info-box -->
         </div>

            <!-- /.col -->

            <!-- /.col -->
            </div>
        </div>
  </section>

  <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Aktivitas Toko</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="callout callout-info">
                                        <small class="text-muted">Omset Harian</small>
                                        <br>
                                        <strong class="h4">Rp 0</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-danger">
                                        <small class="text-muted">Pelanggan Baru (H-7)</small>
                                        <br>
                                        <strong class="h4">0</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-primary">
                                        <small class="text-muted">Perlu Dikirim</small>
                                        <br>
                                        <strong class="h4">0</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Total Produk</small>
                                        <br>
                                        <strong class="h4">0</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              Grafik Penjualan
            </div>
            <div class="box-body">
              <canvas id="myChart" ></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection

@section('script')
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @php echo json_encode($nama_produk); @endphp,
        datasets: [{
          label: 'Grafik Penjualan',
          data: @php echo json_encode($jumlah_penjualan); @endphp,
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255,99,132,1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
  });
</script>
@endsection
