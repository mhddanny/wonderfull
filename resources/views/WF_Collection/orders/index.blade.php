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
            <h2>List Pesanan</h2>
            <div class="page_link">
              <a href="{{ url('/') }}">Home</a>
              <span>
                <i class="fas fa-arrow-right"></i>
              </span>
              <a href="{{ route('customer.orders') }}">List Pesanan</a>
            </div>
            <ol class="breadcrumb float-sm-center">
              <li class="breadcrumb-item"><a href="{{ route('home_web')}}">Home</a></li>
              <li class="breadcrumb-item active">List Pesanan</li>
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
                      <h4 class="card-title">List Pesanan</h4>
                  </div>
                  @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                  @endif
                  <div class="card-body">
                    @if (session('error'))
                      <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('customer.order_accept') }}" class="form-inline" onsubmit="return confirm('Kamu Yakin?');" method="post">
                       @csrf
                      <div class="table-responsive">
                          <table class="table table-hover table-bordered">
                              <thead>
                                  <tr>
                                      <th>Invoice</th>
                                      <th>Penerima</th>
                                      <th>No Telp</th>
                                      <th>Total</th>
                                      <th>Status</th>
                                      <th>Tanggal</th>
                                      <th>Total</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @forelse ($orders as $row)
                                  <tr>
                                      <td>
                                        <strong>{{ $row->invoice }}</strong><br>
                                        @if ($row->return_count == 1)
                                          <small>Return: {!! $row->return->status_label !!}</small>
                                        @endif
                                      </td>
                                      <td>{{ auth()->guard('customer')->user()->name }}</td>
                                      <td>{{ auth()->guard('customer')->user()->nohp }}</td>
                                      <td>@rupiah($row->subtotal)</td>
                                      <td>{!! $row->status_label !!}</td>
                                      <td>{{ $row->created_at }}</td>
                                      <td>@rupiah($row->total)</td>
                                      <td>
                                          <a href="{{ route('customer.view_order', $row->invoice) }}" class="btn btn-outline-primary btn-sm"><i class="far fa-eye"></i> Detail</a>
                                          <input type="hidden" name="order_id" value="{{ $row->id }}">
                                          @if ($row->status == 3)
                                              <button class="btn btn-outline-success btn-sm mt-1"><i class="fas fa-check"></i> Terima</button>
                                              <!-- TOMBOL RETURN AKAN DITEMPATKAN DISINI PADA SUB-BAB SELANJUTNYA -->
                                              <a href="{{ route('customer.order_return', $row->invoice) }}" class="btn btn-outline-danger btn-sm mt-1"><i class="fas fa-edit"></i> Return</a>
                                          @endif
                                      </td>
                                  </tr>
                                @empty
                                  <tr>
                                      <td colspan="7" class="text-center">Tidak ada pesanan</td>
                                  </tr>
                                @endforelse
                              </tbody>
                          </table>
                      </div>
                    </form>
                    <div class="float-right">
                        {!! $orders->links() !!}
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
