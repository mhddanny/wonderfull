@extends('web.layouts.master_web')

@section('title')
  Checkout
@endsection

@section('css')

@endsection

@section('section')

  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Check out</li>
        </ol>
      </div><!--/breadcrums-->

      @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <h4>Bill To</h4>
      <div class="shopper-informations">
        <form class="" action="{{ route('store_checkout') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-8">

                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" id="name">
                  @if (@$errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" id="email">
                  @if (@$errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('ktp') ? 'has-error' : ''}}">

                  <input type="number" class="form-control" name="ktp" placeholder="KTP" value="{{ old('ktp') }}" id="ktp">
                  @if (@$errors->has('ktp'))
                    <span class="help-block">{{$errors->first('ktp')}}</span>
                  @endif

                </div>

                <div class="form-group {{$errors->has('nohp') ? 'has-error' : ''}}">

                  <input type="number" class="form-control" name="nohp" placeholder="NO Hp" value="{{ old('nohp') }}" id="nohp">
                  @if (@$errors->has('nohp'))
                    <span class="help-block">{{$errors->first('nohp')}}</span>
                  @endif

                </div>

                <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                  <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>
                  @if (@$errors->has('alamat'))
                    <span class="help-block">{{$errors->first('alamat') }}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('province_id') ? 'has-error' : ''}}">
                  <select class="form-control" name="province_id" id="province_id" required>
                    <option>-- Province --</option>
                    @foreach ($provinces as $row)
                      <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group {{$errors->has('city_id') ? 'has-error' : ''}}">
                  <select class="form-control" name="city_id" id="city_id" required>
                    <option value="">-- Kota --</option>
                  </select>
                </div>

                <div class="form-group {{$errors->has('district_id') ? 'has-error' : ''}}">
                  <select class="form-control" name="district_id" id="district_id" required>
                    <option value="">-- Kecamatan --</option>
                  </select>
                </div>

            </div>

            <div class="col-sm-4">
              <div class="register-req">
                <table class="table table-condensed total-result">
                  <tr>
                    <h4>Ringkasan Pesanan</h4>
                  </tr>
                  <tr>
                    <td>Cart Sub Total</td>
                    <td></td>
                    <td>@rupiah($subtotal)</td>
                  </tr>
                  <tr>
                    @foreach ($carts as $cart)
                      <td>Jumlah</td>
                      <td>x {{$cart['qty']}}</td>
                      <td>@rupiah($cart['harga'])</td>
                    @endforeach
                  </tr>
                  <tr class="shipping-cost">
                    <td>Biaya Pengiriman</td>
                    <td></td>
                    <td>Free</td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td></td>
                    <td><span>@rupiah($subtotal)</span></td>
                  </tr>
                </table>

                <button class="btn btn-primary" type="submit" name="button"> continue </button>

              </div>
            </div>

        </div>
      </form>

      {{-- <div class="checkout-options">
        <h3>New User</h3>
        <p>Checkout options</p>
        <ul class="nav">
          <li>
            <label><input type="checkbox"> Register Account</label>
          </li>
          <li>
            <label><input type="checkbox"> Guest Checkout</label>
          </li>
          <li>
            <a href=""><i class="fa fa-times"></i>Cancel</a>
          </li>
        </ul>
      </div><!--/checkout-options-->

      <div class="register-req">
        <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
      </div><!--/register-req-->

      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-3">
            <div class="shopper-info">
              <p>Shopper Information</p>
              <form>
                <input type="text" placeholder="Display Name">
                <input type="text" placeholder="User Name">
                <input type="password" placeholder="Password">
                <input type="password" placeholder="Confirm password">
              </form>
              <a class="btn btn-primary" href="">Get Quotes</a>
              <a class="btn btn-primary" href="{{ route('store_checkout') }}">Continue</a>
            </div>
          </div>
            <div class="col-sm-5 clearfix">
              <div class="bill-to">
                <p>Bill To</p>
                <div class="form-one">
                  <form method="post" >
                    @csrf
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" id="name">
                      @if (@$errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                      @endif

                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" id="email">
                      @if (@$errors->has('email'))
                        <span class="help-block">{{$errors->first('email')}}</span>
                      @endif

                    <input type="number" class="form-control" name="ktp" placeholder="KTP" value="{{ old('ktp') }}" id="ktp">
                      @if (@$errors->has('ktp'))
                        <span class="help-block">{{$errors->first('ktp')}}</span>
                      @endif

                    <input type="number" class="form-control" name="nohp" placeholder="NO Hp" value="{{ old('nohp') }}" id="nohp">
                      @if (@$errors->has('nohp'))
                        <span class="help-block">{{$errors->first('nohp')}}</span>
                      @endif

                    <input type="text" placeholder="alamat" id>
                  </form>
                </div>
                <div class="form-two">
                  <form method="post" >
                    @csrf
                    <select class="form-control" name="province_id" id="province_id" required>
                      <option>-- Province --</option>
                         @foreach ($provinces as $row)
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                         @endforeach
                    </select>

                    <select class="form-control" name="city_id" id="city_id" required>
                      <option value="">-- Kota --</option>
                    </select>

                    <select class="form-control" name="district_id" id="district_id" required>
                      <option value="">-- Kecamatan --</option>
                    </select>

                    <input class="form-control" type="text" placeholder="Zip / Postal Code *">
                  </form>
                </div>
              </div>
            </div>


        </div>
      </div>
      <div class="review-payment">
        <h2>Review & Payment</h2>
      </div>

      <div class="table-responsive cart_info">
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
            @foreach ($carts as $row)
              <tr>
                <td class="cart_product">
                  <a href=""><img src="{{ asset('uploads/'.$row['gambar_produk']) }}" width="80" height="80" alt=""></a>
                </td>
                <td class="cart_description">
                  <h4><a href="">{{ $row['nama_produk']}}</a></h4>
                  <p>{{ $row['kode']}}</p>
                </td>
                <td class="cart_price">
                  <p>@rupiah($row['harga'])</p>
                </td>
                <td class="cart_quantity">
                  <p>{{ $row['qty'] }}</p>
                </td>
                <td class="cart_total">
                  <p class="cart_total_price">@rupiah($row['harga'] * $row['qty'])</p>
                </td>
                <td class="cart_delete">
                  <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                </td>
              </tr>
            @endforeach

            <tr>
              <td colspan="4">&nbsp;</td>
              <td colspan="2">
                <table class="table table-condensed total-result">
                  <tr>
                    <td>Cart Sub Total</td>
                    <td>@rupiah($subtotal)</td>
                  </tr>
                  <tr>
                    <td>Exo Tax</td>
                    <td>$2</td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Biaya Pengiriman</td>
                    <td>Free</td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td><span>@rupiah($subtotal)</span></td>
                  </tr>
                </table>
              </td>
            </tr>

          </tbody>
        </table>
      </div> --}}

      <div class="payment-options">
          {{-- <span>
            <label><input type="checkbox"> Direct Bank Transfer</label>
          </span>
          <span>
            <label><input type="checkbox"> Check Payment</label>
          </span>
          <span>
            <label><input type="checkbox"> Paypal</label>
          </span>
        </div> --}}
    </div>
  </section> <!--/#cart_items-->

@endsection

@section('script')

  <script>
    $(document).ready(function(){
        //KETIKA SELECT BOX DENGAN ID province_id DIPILIH
        $('#province_id').on('change', function() {
            //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
            //DAN MENGIRIMKAN DATA PROVINCE_ID
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { province_id: $(this).val() },
                success: function(html){
                    //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                    $('#city_id').empty()
                    //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                    //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                    $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })

        //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
        $('#city_id').on('change', function() {
            $.ajax({
                url: "{{ url('/api/district') }}",
                type: "GET",
                data: { city_id: $(this).val() },
                success: function(html){
                    $('#district_id').empty()
                    $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                    $.each(html.data, function(key, item) {
                        $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                    })
                }
            });
        })
        });
  </script>

@endsection
