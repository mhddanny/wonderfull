@extends('wonderful.layouts.master')

@section('title')
  Admin | Edit Customer New
@endsection

@section('css')

@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Edit Data Customer</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Data Customers</a></li>
            <li class="breadcrumb-item active">Edit Customer</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content-header">
    <div class="container-fluid">
      <div class="col-md-12">
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Masukan Data Customer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal"  method="post" autocomplete="off" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row {{ $errors->has('nama_customer') ? 'has-error' : '' }}">
                    <label for="nama_customer" class="col-sm-2 col-form-label">Nama Panjang</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama_customer" class="form-control" id="nama_customer" placeholder="Nama Panjang" value="{{ $customer->name }}" required>
                      @if (@$errors->has('nama_customer'))
                       <span class="help-block">{{$errors->first('nama_customer')}}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row {{ $errors->has('ktp') ? 'has-error' : '' }}">
                    <label for="ktp" class="col-sm-2 col-form-label">No Ktp</label>
                    <div class="col-sm-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="number" name="ktp" class="form-control" id="ktp" placeholder="No KTP" value="{{ $customer->ktp }}" required>
                        @if (@$errors->has('ktp'))
                         <span class="help-block">{{$errors->first('ktp')}}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group row {{ $errors->has('nohp') ? 'has-error' : '' }}">
                    <label for="nohp" class="col-sm-2 col-form-label">No HP</label>
                    <div class="col-sm-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" name="nohp" class="form-control" id="nohp" placeholder="No Hp" value="{{ $customer->nohp }}" required>
                        @if (@$errors->has('nohp'))
                         <span class="help-block">{{$errors->first('nohp')}}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email" name="email" value="{{ $customer->email }}" required>
                        @if (@$errors->has('email'))
                          <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group row{{ $errors->has('password') ? 'has-error' : '' }}">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" value="">
                        @if (@$errors->has('password'))
                         <span class="help-block">{{$errors->first('password')}}</span>
                        @endif
                      </div>
                  </div>
                  <div class="form-group row">
                    <label for="is_aktif" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select name="is_aktif" id="is_aktif" class="form-control" required>
                        <option value="1" @if ($customer->is_aktif == "1")
                          Selected
                        @endif>Aktif</option>
                        <option value="0" @if ($customer->is_aktif == "0")
                          Selected
                        @endif>Tidak Aktif</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row {{ $errors->has('province_id') ? 'has-error' : '' }}">
                    <label for="province_id" class="col-sm-2 col-form-label">Province</label>
                    <div class="col-sm-10">
                      <select class="custom-select d-block w-100" name="province_id" id="province_id" >
                        <option value="">-- Province --</option>
                        @foreach ($provinces as $row)
                        <option value="{{ $row->id }}" {{ $customer->district->province_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                        @endforeach
                      </select>
                        @if (@$errors->has('province_id'))
                          <span class="help-block">{{$errors->first('province_id')}}</span>
                        @endif
                    </div>
                  </div>
                  <div class="form-group row {{$errors->has('city_id') ? 'has-error' : ''}}">
                    <label for="city_id" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                      <select class="custom-select d-block w-100" name="city_id" id="city_id" >
                        <option value="">-- Kota --</option>
                      </select>
                        @if (@$errors->has('city_id'))
                          <span class="help-block">{{$errors->first('city_id')}}</span>
                        @endif
                    </div>
                  </div>
                  <div class="form-group row {{$errors->has('district_id') ? 'has-error' : ''}}">
                    <label for="district_id" class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-10">
                      <select class="custom-select d-block w-100" name="district_id" id="district_id" >
                        <option value="">-- Kecamatan --</option>
                      </select>
                        @if (@$errors->has('district_id'))
                          <span class="help-block">{{$errors->first('district_id')}}</span>
                        @endif
                    </div>
                  </div>
                  <div class="form-group row {{ $errors->has('alamat') ? 'has-error' : '' }}">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat">{{ $customer->alamat }}</textarea>
                      @if (@$errors->has('alamat'))
                       <span class="help-block">{{$errors->first('alamat')}}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <a href="{{ route('customer.index') }}" type="submit" class="btn btn-default float-right">Cancel</a>
                </div>

                <!-- /.card-footer -->
              </form>
            </div>
          </div>
      </div>
  </section>
@endsection
@section('script')
  <script>
      //JADI KETIKA HALAMAN DI-LOAD
      $(document).ready(function(){
          //MAKA KITA MEMANGGIL FUNGSI LOADCITY() DAN LOADDISTRICT()
          //AGAR SECARA OTOMATIS MENGISI SELECT BOX YANG TERSEDIA
          loadCity($('#province_id').val(), 'bySelect').then(() => {
              loadDistrict($('#city_id').val(), 'bySelect');
          })
      })

      $('#province_id').on('change', function() {
          loadCity($(this).val(), '');
      })

      $('#city_id').on('change', function() {
          loadDistrict($(this).val(), '')
      })

      function loadCity(province_id, type) {
          return new Promise((resolve, reject) => {
              $.ajax({
                  url: "{{ url('/api/city') }}",
                  type: "GET",
                  data: { province_id: province_id },
                  success: function(html){
                      $('#city_id').empty()
                      $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                      $.each(html.data, function(key, item) {

                          // KITA TAMPUNG VALUE CITY_ID SAAT INI
                          let city_selected = {{ $customer->district->city_id }};
                         //KEMUDIAN DICEK, JIKA CITY_SELECTED SAMA DENGAN ID CITY YANG DOLOOPING MAKA 'SELECTED' AKAN DIAPPEND KE TAG OPTION
                          let selected = type == 'bySelect' && city_selected == item.id ? 'selected':'';
                          //KEMUDIAN KITA MASUKKAN VALUE SELECTED DI ATAS KE DALAM TAG OPTION
                          $('#city_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                          resolve()
                      })
                  }
              });
          })
      }

      //CARA KERJANYA SAMA SAJA DENGAN FUNGSI DI ATAS
      function loadDistrict(city_id, type) {
          $.ajax({
              url: "{{ url('/api/district') }}",
              type: "GET",
              data: { city_id: city_id },
              success: function(html){
                  $('#district_id').empty()
                  $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                  $.each(html.data, function(key, item) {
                      let district_selected = {{ $customer->district->id }};
                      let selected = type == 'bySelect' && district_selected == item.id ? 'selected':'';
                      $('#district_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                  })
              }
          });
      }
  </script>
@endsection
