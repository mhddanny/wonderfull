@extends('WF_Collection.layouts.master_web1')

@section('title')
  Order {{ $order->invoice }} - WF Collection
@endsection

@section('css')

@endsection

@section('section')

  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content text-center">
          <h2>Order {{ $order->invoice }}</h2>
          <div class="page_link">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('customer.orders') }}">Order {{ $order->invoice }}</a>
          </div>
          <ol class="breadcrumb float-sm-center">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Inline Charts</li>
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
						<div class="col-md-6">
							<div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pelanggan</h4>
                </div>
								<div class="card-body">
									<table>
                    <tr>
                      <td width="30%">InvoiceID</td>
                      <td width="5%">:</td>
                      <th><strong>{{ $order->invoice }}</strong></th>
                      <th><a href="{{ route('customer.order_pdf', $order->invoice) }}" target="_blank" class="btn btn-sm btn-default"><i class="fas fa-print"></i> Print</a></th>
                    </tr>

                      <tr>
                          <td width="30%">Nama Lengkap</td>
                          <td width="5%">:</td>
                          <th>{{ auth()->guard('customer')->user()->name }}</th>
                      </tr>
                      <tr>
                          <td>No Telp</td>
                          <td>:</td>
                          <th>{{ auth()->guard('customer')->user()->nohp }}</th>
                      </tr>
                      <tr>
                          <td>Alamat</td>
                          <td>:</td>
                          <th>{{ auth()->guard('customer')->user()->alamat }}, {{ $order->district->name }} {{ $order->district->city->name }}, {{ $order->district->city->province->name }}</th>
                      </tr>
                  </table>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Pembayaran<br>
                        <br>
                        @if ($order->status == 0)
                        <a href="{{ route('customer.paymentForm' , $order->id) }}" class="btn btn-primary btn-sm float-center">Konfirmasi</a>
                        @endif
                    </h4>
                </div>
								<div class="card-body">
                  @if ($order->payment)
									<table>
                      <tr>
                          <td width="30%">Nama Pengirim</td>
                          <td width="5%"></td>
                          <td>{{ $order->payment->name }}</td>
                      </tr>
                      <tr>
                          <td>Tanggal Transfer</td>
                          <td></td>
                          <td>{{ $order->payment->transfer_date }}</td>
                      </tr>
                      <tr>
                          <td>Jumlah Transfer</td>
                          <td></td>
                          <td>@rupiah($order->payment->amount) </td>
                      </tr>
                      <tr>
                          <td>Tujuan Transfer</td>
                          <td></td>
                          <td>{{ $order->payment->transfer_to }}</td>
                      </tr>
                      <tr>
                          <td>Bukti Transfer</td>
                          <td></td>
                          <td>
                              <img src="{{ asset('uploads/customer/payment/' . $order->payment->proof) }}" width="50px" height="50px" alt="">
                              <a href="{{ asset('uploads/customer/payment/' . $order->payment->proof) }}" target="_blank">Lihat Detail</a>
                          </td>
                      </tr>
                  </table>
                  @else
                  <h4 class="text-center">Belum ada data pembayaran</h4>
                  @endif
								</div>
							</div>
              </div>
              <div class="col-md-12 mt-4">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Detail</h4>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th>Nama Produk</th>
                                          <th>Harga</th>
                                          <th>Quantity</th>
                                          <th>Berat</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($order->details as $row)
                                      <tr>
                                          <td>{{ $row->produk->nama_produk }}</td>
                                          <td>@rupiah($row->price)</td>
                                          <td>{{ $row->qty }} Item</td>
                                          <td>{{ $row->weight }} gr</td>
                                      </tr>
                                      @empty
                                      <tr>
                                          <td colspan="4" class="text-center">Tidak ada data</td>
                                      </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
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

@endsection
