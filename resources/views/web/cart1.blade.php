@extends('web.layouts.master_web')

@section('title')
  Cart
@endsection

@section('css')

@endsection

@section('section')
  <form action="{{ route('update_cart') }}" method="post">
    @csrf
      <section id="cart_items">
        <div class="container">
          <div class="breadcrumbs">
            <div class="row mb-2">
              <div class="col-sm-6">
                <div class="py-1 text-center">
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
          </div>



          <div class="table-responsive cart_info">
            @if (!session($carts))
              @foreach ($carts as $row)
                <table class="table table-condensed">
                  <thead>
                    <tr class="cart_menu">
                      <th class="image">Item</th>
                      <th class="price">Price</th>
                      <th width="5%">Quantity</th>
                      <th class="total">Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="cart_product">
                        <a><img src="{{ asset('uploads/'.$row['gambar_produk']) }}" width="80" height="80"  alt=""></a>
                      </td>
                      <td class="cart_description">
                        <h5><a>{{ $row['nama_produk']}}</a></h5>
                        <p>{{ $row['kode']}}</p>
                      </td>
                      <td class="cart_price">
                        <p>@rupiah($row['harga'])</p>
                      </td>
                      <td class="cart_quantity">
                        <div class="cart_quantity_button">
                          <a class="cart_quantity_up" onclick="var result = document.getElementById('sst{{ $row['kd_produk'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"> + </a>
                          <input class="cart_quantity_input" type="text" name="qty[]" id="sst{{ $row['kd_produk'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="input-text qty">
                          <input type="hidden" name="kd_produk[]" value="{{ $row['kd_produk'] }}" class="form-control">
                          <a class="cart_quantity_down" onclick="var result = document.getElementById('sst{{ $row['kd_produk'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"> - </a>
                        </div>
                      </td>
                      <td class="cart_total">
                        <p class="cart_total_price"> @rupiah($row['harga'] * $row['qty']) </p>
                      </td>
                      <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{ url('/cart/remove/'. $row['kd_produk'])}}"><i class="fa fa-times"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>

              @endforeach
            @else
              <table class="table table-condensed">
                <thead>
                  <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <h4 class="center">Tidak ada belanjaan</h4>
                    </td>
                  </tr>
                </tbody>
              </table>
            @endif
          </div>
        </div>
      </section> <!--/#cart_items-->

      <section id="do_action">
          <div class="container">
            <div class="heading">
              <h3>Apakah sudah sesuai yang Anda inginkan?</h3>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="total_area">
                  <ul>
                    <li>Cart Sub Total <span>@rupiah($subtotal)</span></li>
                    <li>Eco Tax <span>$2</span></li>
                    <li>Biaya Pengiriman <span>Free</span></li>
                    <li>Total <span>$61</span></li>
                  </ul>
                    <button type="submit" name="button" class="btn btn-default update">Update</button>
                    <a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
                </div>
              </div>
            </div>
          </div>
        </section><!--/#do_action-->
    </form>

@endsection

@section('script')

@endsection
