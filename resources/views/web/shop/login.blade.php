@extends('web.layouts.master_web')

@section('title')
  Cart
@endsection

@section('css')

@endsection

@section('section')

  <section id="form"><!--form-->
		<div class="container">
			<div class="row">

        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#" >
              @csrf
							<input type="text" placeholder="Name" />
							<input type="email" placeholder="Email Address" />
							<span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ route('customer.post_login') }}" method="post" id="contactForm" novalidate="novalidate">
							<input type="text" placeholder="Name"/>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email Address"/>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection

@section('script')

@endsection
