@extends('WF_Collection.layouts.master_web1')

@section('title')
  Wonderful Collection
@endsection

@section('css')

@endsection

@section('section')
{{-- 
  <section class="content">
    <div class="content">
      <div class="container">
        <a href="http://www.phptherightway.com">
          <img src="http://www.phptherightway.com/images/banners/leaderboard-728x90.png" alt="PHP: The Right Way"/>
      </a>
      </div>
    </div>
  </section> --}}
  
  <section class="content">
    <div class="content">
      <div class="container">
        <div class="col-md-12 mt-6 mb-6">
          <!-- /.card-header -->
          <div class="card-body ">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item">
                  <img class="d-block w-100" src="https://placehold.it/900x200/39CCCC/ffffff&amp;text=I+Love+Bootstrap" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="https://placehold.it/900x200/3c8dbc/ffffff&amp;text=I+Love+Bootstrap" alt="Second slide">
                </div>
                <div class="carousel-item active">
                  <img class="d-block w-100" src="https://placehold.it/900x200/f39c12/ffffff&amp;text=I+Love+Bootstrap" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <!-- /.card-body -->
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="main_box">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center mt-4 mb-4">
            <h2>Produk Terbaru</h2>
						<p>Tampil trendi dengan kumpulan produk kekinian kami.</p>
          </div>
        </div>
        <div class="row">
          @forelse ($produk as $row)
            <div class="col-sm-3">
              <div class="card card-primary card-outline">
                <div class="card-header ">
                  <img src="{{ asset('uploads/'.$row->gambar_produk) }}"  style="width:300px;height:250px;" class="img-thumbnail" alt="...">
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <h5>{{ $row->nama_produk}}</h5>
                    <p class="card-text">@rupiah($row->harga)</p>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-center">
                    <a href="{{ url('/produks/'. $row->kd_produk) }}" class="btn btn-block btn-outline-primary btn-sm"><i class="fa fa-shopping-cart"></i> Produk Detail</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
          @empty
            <div class="col-lg-12">
                <h3 class="text-center">Tidak ada produk</h3>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </section>


@endsection

@section('script')

@endsection
