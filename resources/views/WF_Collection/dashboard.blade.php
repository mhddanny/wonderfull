@extends('WF_Collection.layouts.master_web1')

@section('title')
  Wonderful Collection
@endsection

@section('css')

@endsection

@section('section')

  <section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
					<h2>Dashboard</h2>
					<div class="page_link">
           <a href="{{ url('/') }}">Home</a>
           <a href="{{ route('customer.dashboard') }}">Dashboard</a>
					</div>
          <ol class="breadcrumb float-sm-center">
            <li class="breadcrumb-item"><a href="{{ route('home_web') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
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
						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3>Belum Dibayar</h3>
									<hr>
									<p>Rp {{ number_format($orders[0]->pending) }}</p>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3>Dikirim</h3>
									<hr>
									<p>{{ $orders[0]->shipping }} Pesanan</p>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card text-center">
								<div class="card-body">
									<h3>Selesai</h3>
									<hr>
									<p>{{ $orders[0]->completeOrder }} Pesanan</p>
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
