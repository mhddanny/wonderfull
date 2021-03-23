@extends('WF_Collection.layouts.master_web1')

@section('title')
  Daftar Komisi | WF-COLLECTION
@endsection

@section('css')

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('section')

  <section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-center">
					<h2>Daftar Komisi</h2>
					<div class="page_link">
           <a href="{{ url('/') }}">Home</a>
           <a href="{{ route('customer.affiliate') }}">Daftar Komisi</a>
					</div>
          <ol class="breadcrumb float-sm-center">
            <li class="breadcrumb-item"><a href="{{ route('home_web') }}">Home</a></li>
            <li class="breadcrumb-item active">Daftar Komisi</li>
          </ol>
				</div>
			</div>
		</div>
	</section>

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
                    <h4 class="card-title">Komisi Afiliasi</h4>
                </div>
                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Invoice</th>
                          <th>Penerima</th>
                          <th>Komisi</th>
                          <th>Status</th>
                          <th>Tanggal</th>
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
                            <td>{{ $row->customer_name }}</td>
                            <td>@rupiah($row->commission)</td>
                            <td>{!! $row->ref_status_label !!}</td>
                            <td>{{ $row->created_at }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="6" class="text-center">Tidak ada komisi</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                    <div class="float-right">
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
      <!-- DataTables -->
      <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
      <script type="text/javascript">
          $(function () {
            $("#example1").DataTable({
              "responsive": true,
              "autoWidth": false,
            });
          });
      </script>
  @endsection
