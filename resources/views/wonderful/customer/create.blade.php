@extends('wonderful.layouts.master')

@section('title')
  Admin | Create Customer New
@endsection

@section('css')

@endsection

@section('section')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Tambah Data Customer Baru</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Data Customers</a></li>
            <li class="breadcrumb-item active">Create Customer Baru</li>
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
                      <input type="text" name="nama_customer" class="form-control" id="nama_customer" placeholder="Nama Panjang" value="{{ old('nama_customer') }}" required>
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
                        <input type="number" name="ktp" class="form-control" id="ktp" placeholder="No KTP" value="{{ old('ktp') }}" required>
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
                        <input type="number" name="nohp" class="form-control" id="nohp" placeholder="No Hp" value="{{ old('nohp') }}" required>
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
                        <input type="email" name="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                        @if (@$errors->has('email'))
                          <span class="help-block">{{$errors->first('email')}}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group row{{ $errors->has('password') ? 'has-error' : '' }}">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" value="{{ old('password') }}" required>
                        @if (@$errors->has('password'))
                         <span class="help-block">{{$errors->first('password')}}</span>
                        @endif
                      </div>
                  </div>
                  <div class="form-group row {{ $errors->has('is_aktif') ? 'has-error' : '' }}">
                    <label for="is_aktif" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select name="is_aktif" id="is_aktif" class="form-control" required>
                        <option value="">Pilih Status :
                        </option><option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                      </select>
                      @if (@$errors->has('is_aktif'))
                       <span class="help-block">{{$errors->first('is_aktif')}}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row {{ $errors->has('province_id') ? 'has-error' : '' }}">
                    <label for="province_id" class="col-sm-2 col-form-label">Province</label>
                    <div class="col-sm-10">
                      <select class="custom-select d-block w-100" name="province_id" id="province_id" >
                        <option value="">-- Province --</option>
                        @foreach ($provinces as $row)
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
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
                      <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>
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
