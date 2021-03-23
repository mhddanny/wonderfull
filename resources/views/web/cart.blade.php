@extends('web.layouts.master_web')

@section('title')
  Cart
@endsection

@section('css')

@endsection

@section('section')
  <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ route('home_web') }}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table id="cart" class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
              <tbody>
                <?php $total = 0 ?>
                @if (session('cart'))
                  @foreach(session('cart') as $id => $details)
                    <?php $total += $details['harga'] * $details['quantity'] ?>

        						<tr>
        							<td class="cart_product">
        								<a  href=""><img src="{{ asset('uploads/'.$details['gambar_produk']) }}" width="150" height="150" class="img-responsive" alt=""></a>
        							</td>
        							<td class="cart_description">
        								<h4><a href="">{{ $details['name'] }}</a></h4>
        								<p>{{ $details['kode'] }}</p>
        							</td>
        							<td class="cart_price">
        								<p>Rp. {{ $details['harga'] }}</p>
        							</td>
        							<td class="cart_quantity">
        								<div class="cart_quantity_button">
        									{{-- <a class="cart_quantity_up" href=""> + </a> --}}
        									<input class="cart_quantity_input" type="number" name="quantity" value="{{ $details['quantity'] }}" autocomplete="off" size="2">
        									{{-- <a class="cart_quantity_down" href=""> - </a> --}}
        								</div>
        							</td>
        							<td class="cart_total">
        								<p class="cart_total_price">{{ $details['quantity'] }}</p>
        							</td>
                      <td class="actions" data-th="">
                          <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                          <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                      </td>
        						</tr>

                @endforeach
              @endif
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
          @if (session('cart'))
            @foreach(session('cart') as $id => $details)
    					<div class="total_area">
    						<ul>
    							<li>Jumlah Keranjang <span>Rp. {{ $details['harga']}}</span></li>
    							<li>Pajak <span>$2</span></li>
    							<li>Biaya Pengiriman <span>Free</span></li>
    							<li>Total <span>Rp. {{ $total }}</span></li>
    						</ul>
    							<a class="btn btn-default update" href="">Update</a>
    							<a class="btn btn-default check_out" href="">Check Out</a>
    					</div>
            @endforeach
          @endif
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection

@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script type="text/javascript">
      $(".update-cart").click(function (e) {
         e.preventDefault();
         var ele = $(this);
          $.ajax({
             url: '{{ url('update-cart') }}',
             method: "patch",
             data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
             success: function (response) {
                 window.location.reload();
             }
          });
      });
      $(".remove-from-cart").click(function (e) {
          e.preventDefault();
          var ele = $(this);
          if(confirm("Are you sure")) {
              $.ajax({
                  url: '{{ url('remove-from-cart') }}',
                  method: "DELETE",
                  data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                  success: function (response) {
                      window.location.reload();
                  }
              });
          }
      });
  </script>
@endsection
