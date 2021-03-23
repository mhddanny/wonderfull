@extends('WF_Collection.layouts.master_web1')

@section('title')
  Keranjang Belanja - Wonderfull Colletion
@endsection

@section('css')

@endsection

@section('section')

  <section  id="cart_items">
    <div class="container">
        <ol class="breadcrumb float-sm-center">
          <li class="breadcrumb-item"><a href="{{ route('home_web')}}">Home</a></li>
          <li class="breadcrumb-item active">Invoice</li>
        </ol>
     <div>
   </section>

   <section class="login_box_area p_120">
     <div class="container">
       <div class="card">
         <div class="card-header">
          <div class="register-req">
            <h5>Terimasih, Pesanan Anda Telah Kami Terima</h5>
          </div><!--/register-req-->
        </div>
        <div class="card-body">
          <div class="shopper-informations">
    				<div class="row">
              <div class="col-sm-6">
    						<div class="shopper-info">
                  <ul class="list">
      							<li>
      								<a href="#">
                        <span>Invoice</span> : {{ $order->invoice }}</a>
      							</li>
      							<li>
      								<a href="#">
                        <span>Tanggal</span> : {{ $order->created_at }}</a>
      							</li>
                    <li>
                      <a href="#">
                        <span>Subtotal</span> : @rupiah($order->subtotal)
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span>Ongkos Kirim</span> : @rupiah($order->cost)
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span>Total</span> : @rupiah($order->total)
                      </a>
                    </li>
      						</ul>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="shopper-info">
                  <ul class="list">
      							<li>
      								<a href="#">
                        <span>Alamat</span> : {{ $order->customer_alamat }}</a>
      							</li>
      							<li>
      								<a href="#">
                        <span>Kota</span> : {{ $order->district->city->name }}</a>
      							</li>
      							<li>
      								<a href="#">
      									<span>Country</span> : Indonesia</a>
      							</li>
      						</ul>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
  </section> <!--/#cart_items-->

@endsection

@section('script')


@endsection
