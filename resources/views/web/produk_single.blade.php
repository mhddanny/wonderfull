@extends('web.layouts.master_web')

@section('title')
  Jual  {{ $produk->nama_produk }}
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
                     <h4 class="panel-title" name="kd_kategori" id="kd_kategori">
                       <a value="{{$kat->kd_kategori}}" href="{{$kat->child_count > 0 ? '#': url('/kategori', ['kat' => $kat->slug])}} ">{{ $kat->kategori }}</a></h4><br>
                     </h4>
                           @foreach ($kat->child as $child)
                             <ul class="list">
                               <li>
                                 <a href="{{ url('/kategori/' . $child->slug) }}">{{ $child->kategori }}</a>
                               </li>
                             </ul>
                           @endforeach

                   @endforeach
                 </div>
               </div>
            </div>
          </div>
        </div>

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{ asset('uploads/'.$produk->gambar_produk) }}" width="300" height="250" alt="" />
								<h3>ZOOM</h3>
							</div>

						</div>
						<div class="col-sm-7">
              <form action="{{ route('addToCart') }}" method="POST">
                @csrf
    							<div class="product-information"><!--/product-information-->
    								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
    								<h2>{{ $produk->nama_produk }}</h2>
    								<p>Kode Barang: {{ $produk->kode }}</p>
    								<img src="images/product-details/rating.png" alt="" />
    								<span>
    									<span>@rupiah($produk->harga)</span>
    									<label for="qty">Quantity:</label>

                      <input type="text" name="qty" id="sst" value="1" title="Quantity:" class="input-text qty" />
                      <!-- BUAT INPUTAN HIDDEN YANG BERISI ID PRODUK -->
                      <input type="hidden" name="kd_produk" value="{{ $produk->kd_produk }}" class="form-control">

                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                      class="increase items-count" type="button">
                        <i class="cart_quantity_up"></i>
                      </button>
                      <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                      class="reduced items-count" type="button">
                        <i class="cart_quantity_down"></i>
                      </button>

    									<button type="submit" class="btn btn-fefault cart">
    										<i class="fa fa-shopping-cart"></i>
    										Add to cart
    									</button>
    								</span>
    								<p><b>Stok Barang:</b> {{ $produk->stok }}</p>
    								<p><b>Berat Barang:</b> {{ $produk->weight}} gram</p>
    								<p><b>Brand:</b> E-SHOPPER</p>
    								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
    							</div><!--/product-information-->
              </form>
						</div>
					</div><!--/product-details-->

				</div>
			</div>
		</div>
	</section>

@endsection

@section('script')

@endsection
