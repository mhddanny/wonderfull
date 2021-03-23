@extends('WF_Collection.layouts.master_web1')

@section('title')
  List Pesanan - WF Collection
@endsection

@section('css')
     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> --}}
@endsection

@section('section')

  <!--================Home Banner Area =================-->
 <section class="banner_area">
   <div class="banner_inner d-flex align-items-center">
     <div class="container">
       <div class="banner_content text-center">
         <h2>Konfirmasi Pembayaran</h2>
         <div class="page_link">
           <a href="{{ url('/') }}">Home</a>
           <a href="{{ route('customer.orders') }}">Konfirmasi Pembayaran</a>
         </div>
         <ol class="breadcrumb float-sm-center">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active">Inline Charts</li>
         </ol>
       </div>
     </div>
   </div>
 </section>
 <!--================End Home Banner Area =================-->

 <!--================Login Box Area =================-->
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
                   <h4 class="card-title">Konfirmasi Pembayaran</h4>
               </div>
               <div class="card-body">
                   <form action="{{ route('customer.savePayment') }}" enctype="multipart/form-data" method="post">
                       @csrf

                       @if (session('success'))
                           <div class="alert alert-success">{{ session('success') }}</div>
                       @endif
                       @if (session('error'))
                           <div class="alert alert-danger">{{ session('error') }}</div>
                       @endif

                       <div class="form-group">
                           <label for="">Invoice ID</label>
                           <input type="text" name="invoice" class="form-control" value="{{ $order->invoice }}" required>
                           <p class="text-danger">{{ $errors->first('invoice') }}</p>
                       </div>
                       <div class="form-group">
                           <label for="">Nama Pengirim</label>
                           <input type="text" name="name" class="form-control" required>
                           <p class="text-danger">{{ $errors->first('name') }}</p>
                       </div>
                       <div class="form-group">
                           <label for="">Transfer Ke</label>
                           <select name="transfer_to" class="form-control" required>
                               <option value="">Pilih</option>
                               <option value="BCA - 1234567">BCA: 1234567 a.n MHD DANNY</option>
                               <option value="Mandiri - 2345678">Mandiri: 2345678 a.n MHD DANNY</option>
                               <option value="BRI - 9876543">BRI: 9876543 a.n MHD DANNY</option>
                               <option value="BNI - 6789456">BNI: 6789456 a.n MHD DANNY</option>
                           </select>
                           <p class="text-danger">{{ $errors->first('transfer_to') }}</p>
                       </div>
                       {{-- <div class="form-group">
                           <label for="">Jumlah Transfer</label>
                           <input type="number" name="amount" class="form-control" required>
                           <p class="text-danger">{{ $errors->first('amount') }}</p>
                       </div> --}}

                       <div class="form-group">
                         <label for="">Jumlah Tagihan Pembayaran</label>
                         <div class="input-group hidden-accessible">
                           <div class="input-group-prepend">
                             <span class="input-group-text">Rp</span>
                           </div>
                           <input type="number" value="{{ $order->subtotal  }}" disabled>
                           <div class="input-group-append">
                             <span class="input-group-text">.00</span>
                           </div>
                         </div>
                       </div>

                       <div class="form-group">
                         <p class="text-danger">Pengirimaan harus sesuai dengan angka jumlah tagihan pembayaran . . . !</p>
                         <label for="">Jumlah Pengiriman</label>
                         <div class="input-group">
                           <div class="input-group-prepend">
                             <span class="input-group-text">Rp</span>
                           </div>
                           <input type="number" name="amount" class="form-control" required>
                           <p class="text-danger">{{ $errors->first('amount') }}</p>
                           <div class="input-group-append">
                             <span class="input-group-text">.00</span>
                           </div>
                         </div>
                       </div>
                       <div class="form-group">
                        <label>Date:</label>
                         <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" name="transfer_date" class="form-control datetimepicker-input" data-target="#datetimepicker4" required/>
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                      </div>
                       <div class="form-group">
                        <!-- <label for="customFile">Custom File</label> -->
                        <label for="proof">Bukti Transfer</label>
                        <div class="custom-file">
                          <input type="file" name="proof" class="custom-file-input" id="customFile" >
                          <label class="custom-file-label" for="customFile">Choose file</label>
                          <p class="text-danger">{{ $errors->first('proof') }}</p>
                        </div>
                      </div>
                       <div class="form-group">
                           <button class="btn btn-primary btn-sm">Konfirmasi</button>
                       </div>
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
