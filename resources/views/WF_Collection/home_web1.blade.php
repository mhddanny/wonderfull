@extends('WF_Collection.layouts.master_web1')

@section('title')
  Wonderful Collection
@endsection

@section('css')
  <style>
    .menu-sidebar-area {
      list-style-type:none; padding-left: 0; font-size: 15pt;
    }
    .menu-sidebar-area > li {
      margin:0 0 10px 0;
      list-style-position:inside;
      border-bottom: 1px solid black;
    }
    .menu-sidebar-area > li > a {
      color: black
    }
</style>
@endsection

@section('section')

  <div class="content-wrapper">

    <section class="jumbotron text-center">
      <div class="container">
        <h1>Album example</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </section>

  <section>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"></rect></svg>
          <div class="container">
            <div class="carousel-caption text-left">
              <h1>Example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item active">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"></rect></svg>
          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"></rect></svg>
          <div class="container">
            <div class="carousel-caption text-right">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>

    <!-- Content Header (Page header) -->
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
    <!-- /.content-header -->

    <!-- Main content -->
    {{-- <section class="container">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
					<div class="col-12">
						<div class="section-title text-center">
							<h2>Trending Item</h2>
						</div>
					</div>
				</div>
        <div class="row ">
            @forelse ($produk as $row)
            <div class="col-sm-3">
              <div class="card card-primary card-outline">
                <div class="card-header ">
                  <h5 class="card-title m-0 text-center">{{ $row->nama_produk}}</h5>
                </div>
                <div class="card-body">
                  <p>Kode</p>
                  <div class="text-center">
                    <img src="{{ asset('uploads/'.$row->gambar_produk) }}"  style="width:300px;height:250px;" class="img-thumbnail" alt="...">
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
            <div class="col-lg-3">
                <h3 class="text-center">Tidak ada produk</h3>
            </div>
          @endforelse

      </div><!-- /.container-fluid -->
      {{ $produk->links() }}
      </div>
    </section> --}}
    <!-- /.content -->

    <section class="container">
      <h4 class="mt-5 text-center ">Produk All</h4>
      <ul class="nav nav-tabs text-center" role="tablist">
        @if (!empty($kategories))

          @foreach ($kategories as $kategori)
          <li class="nav-item">
            <a class="nav-link text-secondary"  href="{{ url('/kategories/'. $kategori->slug)}}" role="tab" aria-controls="custom-content" aria-selected="true">{{ $kategori->kategori }}</a>
          </li>
        @endforeach

      @endif
      </ul>
      <div class="tab-custom-content">
        <p class="lead mb-0"></p>
      </div>
      <div class="tab-content" >
        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="custom-content-above-home-tab">

          <div class="row ">
              @forelse ($produk as $row)
              <div class="col-sm-3">
                <div class="card card-primary card-outline">
                  <div class="card-header ">
                    <h5 class="card-title m-0 text-center">{{ $row->nama_produk}}</h5>
                  </div>
                  <div class="card-body">
                    <p>Kode</p>
                    <div class="text-center">
                      <img src="{{ asset('uploads/'.$row->gambar_produk) }}"  style="width:300px;height:250px;" class="img-thumbnail" alt="...">
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

          </div><!-- /.container-fluid -->
          {{-- {{ $produk->links() }} --}}

        </div>
      </div>
    </section>



@endsection

@section('script')

@endsection
