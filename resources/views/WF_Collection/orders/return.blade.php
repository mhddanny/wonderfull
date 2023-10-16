@extends('WF_Collection.layouts.master_web1')

@section('title')
  List Pesanan - WF Collection
@endsection

@section('css')

@endsection

@section('section')

  <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div class="banner_content text-center">
            <h2>Return {{ $order->invoice }}</h2>
            <div class="page_link">
              <a href="{{ url('/') }}">Home</a>
              <span>
                <i class="fas fa-arrow-right"></i>
              </span>
              <a href="{{ route('customer.orders') }}">Return {{ $order->invoice }}</a>
            </div>
            <ol class="breadcrumb float-sm-center">
              <li class="breadcrumb-item"><a href="{{ route('home_web')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('customer.orders') }}">Return {{ $order->invoice }}</a></li>
              <li class="breadcrumb-item active">Pesanan {{ $order->invoice }}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="login_box_area p_120">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            @include('WF_Collection.layouts.module.sidebar')
          </div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                      <h4 class="card-title">Return {{ $order->invoice }}</h4>
                  </div>
                  @if (session('success'))
                   <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  <div class="card-body">
                    <form action="{{ route('customer.return', $order->id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="">Alasan Return</label>
                            <textarea name="reason" cols="5" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Refund Transfer</label>
                            <input type="text" name="refund_transfer" class="form-control" required>
                        {{-- </div>
                        <div class="form-group">
                            <label for="">Foto</label>
                            <input type="file" name="photo" class="form-control" required>
                        </div> --}}
                        <div class="form-group">
                          <label for="exampleInputFile">Foto</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" required>
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary">Kirim</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@section('script')
  <script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
            });
            $(document).ready(function () {
              bsCustomFileInput.init();
            });
   </script>

@endsection
