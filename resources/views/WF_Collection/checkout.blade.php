@extends('WF_Collection.layouts.master_web1')

@section('title')
  Daftar Keranjang
@endsection

@section('css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
@endsection

@section('section')

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home_web') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('listcart') }}">Card</a></li>
              <li class="breadcrumb-item active">Checkout</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <section class="conten-body">
      <div class="container">
        <div class="py-5 text-center">
          {{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> --}}
          <h2>Checkout</h2>
          <p class="lead">Masukan Data Informasi Pengiriman  ...!</p>
        </div>

        <div class="row">
          <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                {{-- @foreach ($carts as $cart)
                  <span class="badge badge-secondary badge-pill">{{ $cart['qty']->count() }}</span>
                @endforeach --}}
              </h4>
              <ul class="list-group mb-3">
                @if (!session($carts))
                  @foreach ($carts as $row)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">{{ $row['nama_produk']}}</h6>
                        <small class="text-muted">{{ $row['kode'] }}</small>
                      </div>
                      <strong class="text-gray-dark">x {{ $row['qty'] }}</strong>
                      <span class="text-muted">@rupiah($row['harga'])</span>
                    </li>
                    {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Second product</h6>
                    <small class="text-muted">Brief description</small>
                  </div>
                  <span class="text-muted">$8</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Third item</h6>
                    <small class="text-muted">Brief description</small>
                  </div>
                  <span class="text-muted">$5</span>
                </li> --}}
                    @endforeach
                      <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Kurir</h6>
                        <small class="text-muted"></small>
                      </div>
                      <span class="ongkir">Rp 0</span>
                    </li>
                  @else
                    <div class="text-center">
                      <h4>Tidak ada Pesanan</h4>
                    </div>
                    @endif
                      {{-- <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                          <h6 class="my-0">Promo code</h6>
                          <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">-$5</span>
                      </li> --}}
                      <li class="list-group-item d-flex justify-content-between">
                          <span>Subtotal </span>
                          <strong>@rupiah($subtotal)</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between">
                          <span>Total </span>
                          <strong id="total">@rupiah($subtotal)</strong>
                      </li>
                </ul>

              {{-- <form class="card p-2">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Promo code">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                  </div>
                </div>
              </form> --}}

          </div>
          <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="" action="{{ route('store_checkout') }}" method="post" >
              @csrf
              <div class="mb-3 {{$errors->has('name') ? 'has-error' : ''}}">
                <label for="name">Nama Lengkap</label>
                <div class="input-group ">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}" required >
                </div>
                @if (@$errors->has('name'))
                  <span class="help-block">{{$errors->first('name')}}</span>
                @endif
              </div>

              {{-- <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                <label for="username">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" placeholder="Username" >
                  @if (@$errors->has('username'))
                    <span class="help-block">{{$errors->first('username')}}</span>
                  @endif
                </div>
              </div> --}}

              <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label for="email">Email</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required
                  required
                  @if (auth()->guard('customer')->check())
                    value="{{ auth()->guard('customer')->user()->email }}"
                    {{ auth()->guard('customer')->check() ? 'readonly':'' }}
                  @else
                    value="{{ old('email') }}"
                  @endif
                    >
                </div>
                  @if (@$errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                  @endif
              </div>
              {{-- <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label for="email">Email</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ auth()->guard('customer')->user()->email() }}" required {{ auth()->guard('customer')->check() ? 'readonly':'' }}>
                </div>
                @if (@$errors->has('email'))
                  <span class="help-block">{{$errors->first('email')}}</span>
                @endif
              </div> --}}

              <div class="form-group {{$errors->has('nohp') ? 'has-error' : ''}}">
                  <label for="nohp">No Tlpn</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control" name="nohp" id="number" placeholder="No Hp" value="{{ old('nohp') }}" required >
                  </div>
                  @if (@$errors->has('nohp'))
                    <span class="help-block">{{$errors->first('nohp')}}</span>
                  @endif
                  <!-- /.input group -->
                </div>

              {{-- <div class="mb-3 {{$errors->has('ktp') ? 'has-error' : ''}}">
                <label for="ktp">KTP</label>
                <input type="number" class="form-control" name="ktp" id="ktp" placeholder="Masukan No KTP" value="{{ old('ktp') }}" >
                  @if (@$errors->has('ktp'))
                    <span class="help-block">{{$errors->first('ktp')}}</span>
                  @endif
              </div> --}}

              <div class="form-group {{$errors->has('ktp') ? 'has-error' : ''}}">
                <label for="ktp">No KTP</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                  </div>
                  <input type="number" class="form-control" name="ktp" id="ktp" placeholder="Masukan No KTP" required
                  @if (auth()->guard('customer')->check())
                    value="{{ auth()->guard('customer')->user()->ktp }}"
                    {{ auth()->guard('customer')->check() ? 'readonly':'' }}
                  @else
                    value="{{ old('ktp') }}"
                  @endif
                </div>
                @if (@$errors->has('ktp'))
                  <span class="help-block">{{$errors->first('ktp')}}</span>
                @endif
              </div>

              <div class="mb-3"  {{$errors->has('alamat') ? 'has-error' : ''}}>
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}" required>
                @if (@$errors->has('alamat'))
                  <span class="help-block">{{$errors->first('alamat') }}</span>
                @endif
              </div>

              {{-- <div class="mb-3">
                <label for="alamat2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
              </div> --}}

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="province_id">Province</label>
                  <select class="custom-select d-block w-100" name="province_id" id="province_id" required>
                    <option value="">-- Province --</option>
                    @foreach ($provinces as $row)
                      <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                  </select>
                    @if (@$errors->has('province_id'))
                      <span class="help-block">{{$errors->first('province_id')}}</span>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                  <label for="city_id">Kota</label>
                  <select class="custom-select d-block w-100" name="city_id" id="city_id" required >
                    <option value="">-- Kota --</option>
                  </select>
                </div>

                <div class="col-md-4 mb-3">
                  <label for="district_id">Kecamatan</label>
                  <select class="custom-select d-block w-100" name="district_id" id="district_id" required >
                    <option value="">-- Kecamatan --</option>
                  </select>
                </div>
                <div class="col-md-12 form-group p_star">
                    <label for="">Kurir</label>
                    <input type="hidden" name="weight" id="weight" value="{{ $weight }}">
                    <select class="form-control" name="courier" id="courier" required>
                        <option value="">--Kurir--</option>
                    </select>
                    <p class="text-danger">{{ $errors->first('courier') }}</p>
                </div>

                {{-- <div class="col-md-3 mb-3">
                  <label for="zip">Kode POS</label>
                  <input type="text" class="form-control" id="zip" placeholder="" >
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>
                </div> --}}
              </div>
              <hr class="mb-4">
              {{-- <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address">
                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
              </div>
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="save-info">
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
              </div>
              <hr class="mb-4">

              <h4 class="mb-3">Payment</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">PayPal</label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required>
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required>
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="cc-cvv">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div> --}}
              <button class="btn btn-primary btn-lg btn-block" type="submit" >Continue to checkout</button>
              <hr class="mb-4">
            </form>
          </div>
        </div>

      </div>
    </section>

  </div>

@endsection

@section('script')
  <!-- Select2 -->
  <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="{{ asset('backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
  <!-- Bootstrap Switch -->
  <script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

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

            //JIKA KECAMATAN DIPILIH
            $('#district_id').on('change', function() {
            //MEMBUAT EFEK LOADING SELAMA PROSES REQUEST BERLANGSUNG
            $('#courier').empty()
            $('#courier').append('<option value="">Loading...</option>')

            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGAMBIL DATA API
            $.ajax({
                url: "{{ url('/api/cost') }}",
                type: "POST",
                data: { destination: $(this).val(), weight: $('#weight').val() },
                success: function(html){
                    //BERSIHKAN AREA SELECT BOX
                    $('#courier').empty()
                    $('#courier').append('<option value="">Pilih Kurir</option>')

                    //LOOPING DATA ONGKOS KIRIM
                    $.each(html.data.results, function(key, item) {
                        let value = item.courier + '-' + item.service + '-'+ item.cost
                        let courier = item.courier + '-' + item.service + ' (Rp '+ item.cost +')'
                        //DAN MASUKKAN KE DALAM OPTION SELECT BOX
                        $('#courier').append('<option value="'+item.courier + '-' + item.service + '-'+ item.cost+'">'+item.courier + '-' + item.service + ' (Rp '+ item.cost +')'+'</option>')
                    })
                }
              });
            })

            //JIKA KURIR DIPILIH
            $('#courier').on('change', function() {
            //UPDATE INFORMASI BIAYA PENGIRIMAN
            let split = $(this).val().split('-')
                        $('#ongkir').text('Rp ' + split[2])

            //UPDATE INFORMASI TOTAL (SUBTOTAL + ONGKIR)
            let subtotal = "{{ $subtotal }}"
            let total = parseInt(subtotal) + parseInt(split['2'])
                        $('#total').text('Rp' + total)
            })
          });
    </script>
@endsection
