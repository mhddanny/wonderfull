@extends('web.layouts.master_web')

@section('title')
    Product
@endsection

@section('css')

@endsection

@section('section')

    <section>
      <div class="container">
          <div class="row">
              <div class="col-sm-3">
                  <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                    <div class="panel panel-default">
                      <div class="panel-heading" name="kd_kategori" id="kd_kategori">
                        @foreach ($kategories as $kat)
                            <h4 class="panel-title" name="kategori" id="kategori">
                              <a value="{{$kat->kd_kategori}}" href="{{ url('/produks.index', ['kat' => $kat->slug])}} ">{{ $kat->kategori }}</a></h4><br>
                            </h4>
                                @foreach ($kat->child as $child)
                                    <ul class="list">
                                       <li>
                                         <a href="{{ url('/produks/' . $child->slug) }}">{{ $child->kategori }}</a>
                                       </li>
                                      </ul>
                                 @endforeach

                             @endforeach
                        </div>
                      </div>

                    </div><!--/category-productsr-->


                  </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                      <h2 class="title text-center">Features Items</h2>
                      @forelse ($produk as $row)
                        <div class="col-sm-4">
                          <div class="product-image-wrapper">
                            <div class="single-products">
                              <div class="productinfo text-center">
                                <img src="{{ asset('uploads/'.$row->gambar_produk) }}" width="400" height="300" alt="" />
                                <h2>@rupiah($row->harga)</h2>
                                <p>{{ $row->nama_produk}}</p>
                                <a href="{{ url('/produks/'. $row->kd_produk) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                              </div>
                              {{-- <div class="product-overlay">
                                <div class="overlay-content">
                                  <h2>@rupiah($row->harga)</h2>
                                  <p>{{ $row->nama_produk}}</p>
                                  <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                              </div> --}}
                            </div>
                            {{-- <div class="choose">
                              <ul class="nav nav-pills nav-justified">
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                              </ul>
                            </div> --}}
                          </div>
                        </div>
                      @empty
                        <div class="col-md-12">
                            <h3 class="text-center">Tidak ada produk</h3>
                        </div>
                      @endforelse

                      <ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                      </ul>
                    </div><!--features_items-->
                  </div>
                </div>
              </div>
            </section>


        </div>
      </div>
    </div>
  </div>
  <!-- End Breadcrumbs -->
@endsection

@section('script')

@endsection
