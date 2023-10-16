@extends('WF_Collection.layouts.master_web1')

@section('title')
  Produk Detail
@endsection

@section('css')
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
@endsection

@section('section')

  <div class="content-wrapper" style="min-height: 1416.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="text-center">
              {{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> --}}
              <h1>Produk Detail : {{ $produk->nama_produk }}</h1>
                          </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home_web') }}">Produk</a></li>
              <li class="breadcrumb-item active">Produk Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @include('alert.succes')
    <!-- Main content -->
    <section class="content-body">
      <div class="container">
        <!-- Default box -->
        <div class="card card-solid">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                <div class="col-12">
                  <img src="{{ asset('uploads/'.$produk->gambar_produk) }}" class="product-image" style="width:400px;height:450px;" alt="Product Image">
                </div>
                <div class="col-12 product-image-thumbs">
                  <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb"><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb"><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb"><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb"><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <form action="{{ route('addToCart') }}" method="POST">
                  @csrf
                  <h3 class="my-3">{{ $produk->nama_produk }}</h3>
                  <p>Kode Produk: {{ $produk->kode}}</p>
                  {!! $produk->ket !!}
                  <p>
                    @if (auth()->guard('customer')->check())
                    <label>Afiliasi Link</label>
                    <input type="text"
                      value="{{ url('/produks/ref/' . auth()->guard('customer')->user()->id . '/' . $produk->kd_produk) }}"
                      readonly class="form-control">
                    @endif
                  </p>

                  <hr>

                  <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                    class="increase items-count" type="button">
                    <i class="fas fa-plus"></i>
                  </button>
                  <input type="text" name="qty" id="sst" value="1" title="Quantity:" class="input-text qty" />
                  <!-- BUAT INPUTAN HIDDEN YANG BERISI ID PRODUK -->
                  <input type="hidden" name="kd_produk" value="{{ $produk->kd_produk }}" class="form-control">
                  <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                    class="reduced items-count" type="button">
                    <i class="fas fa-minus"></i>
                  </button>

                  <div class="bg-primary color-palette py-2 px-3 mt-4">
                    <h2 class="mb-0">
                      @rupiah($produk->harga)
                    </h2>
                    <h4 class="mt-0">
                      <small>Ex Tax: @rupiah($produk->harga) </small>
                    </h4>
                  </div>

                <div class="mt-4">
                  <button type="submit" class="btn btn-success cart">
                    <i class="fa fa-shopping-cart mr-2"></i>
                    Add to cart
                  </button>
                  @if (session('success'))
                  <div class="alert alert-success mt-2">{{ session('success') }}</div>
                  @endif
                  {{-- <button type="submit" class="btn btn-success toastrDefaultSuccess">
                    <i class="fa fa-shopping-cart mr-2"></i>
                    Add to cart
                  </button> --}}

                  {{-- <button type="submit" class="btn btn-success swalDefaultSuccess">
                    <i class="fa fa-shopping-cart mr-2"></i>
                    Add to cart
                  </button> --}}

                  <div class="btn btn-default">
                    <i class="fas fa-heart fa-lg mr-2"></i>
                    Add to Wishlist
                  </div>
                </div>

                <div class="mt-4 product-share">
                  <a href="#" class="text-gray">
                    <i class="fab fa-facebook-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fab fa-twitter-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fas fa-envelope-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fas fa-rss-square fa-2x"></i>
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      </div>

    </section>
    <!-- /.content -->
  </div>

@endsection

@section('script')
  <!-- SweetAlert2 -->
  <script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
  <script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          icon: 'success',
          title: 'Produk berhasil dimasukan ke dalam Keranjang'
        })
      });
    });

    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

  </script>
@endsection
