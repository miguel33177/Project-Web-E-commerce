<!-- TOP HEADER -->
<div id="top-header">
	<div class="container">
		<ul class="header-links pull-left">
			<li><a><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
						<path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
						<path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
					</svg> ...numero de telemovel... </a></li>
			<li><a><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
						<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
					</svg> ...email... </a></li>
			<li><a><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
						<path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
					</svg> ...morada...</a></li>
		</ul>
		<ul class="header-links pull-right">
			<!-- Authentication Links -->
			@guest
			@if (Route::has('login'))
			<li class="nav-item">
				<a href="{{ route('login') }}"><button class="buttonLogin2">{{ __('Login') }}</button></a>
			</li>
			@endif

			@if (Route::has('register'))
			<li class="nav-item">
				<a class="nav-link" href="{{ route('register') }}"><button class="buttonRegister2">{{ __('Register') }}</button></a>
			</li>
			@endif
			@else

			<a style="color:#FFFFFF">
				Hello, {{ Auth::user()->name }}
			</a>

			<div class="header-links pull-right">
				@if(Auth::user()->isAdmin==true)
				<a href="{{ route('adminView', Auth::user()->name) }}"><button class="buttonMyAccount">Admin Interface</button></a>
				@endif
				<a href="{{ route('myAccount', Auth::user()->name) }}"><button class="buttonMyAccount">My Account</button></a>
				<button class="buttonLogout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
				</button>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
			</div>

			@endguest
		</ul>
	</div>
</div>
<!-- /TOP HEADER -->

<!-- MAIN HEADER -->
<div id="header">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- LOGO -->
			<div class="col-md-3">
				<div class="header-logo">
					<a href="/" class="logo">
						<img src="{{ URL::asset('assets/img/logo12.png')}}" alt="">
					</a>
				</div>
			</div>
			<!-- /LOGO -->

			<!-- SEARCH BAR -->
			<div class="col-md-6">
				<div class="header-search">
					<form action="{{route ('search')}}" method="GET">
						<input type="text" name="query" class="input" placeholder="Search here">
						<button type="submit" class="buttonSearch"> Search</button>
					</form>
				</div>
			</div>

			
			<!-- /SEARCH BAR -->

			<!-- ACCOUNT -->
			<div class="col-md-13 ">
				<div class="header-ctn">
					<!-- Cart -->
					
					@if (empty(Auth::user()->email_verified_at))
					@else
					<!-- /Cart -->

					<!-- Wishlist -->
					<div>
						<a href="{{ route('addProduct', Auth::user()->name) }}">
							<i>
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
								</svg></i>
								<span>Add Product</span>
						</a>
					</div>
					<div>
						<a href="/myWishlist">
							<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
									<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
								</svg></i>
							<span>Your Wishlist </span>
							<div class="qty">{{$countWishlist}}</div>
						</a>
					</div>
					<div>
						<a href="/myCart">
							<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
									<path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
								</svg></i>
							<span>Your Cart</span>
							<div class="qty">{{$countCart}}</div>
						</a>
					</div>
					@endif
				</div>
			</div>
			<!-- /ACCOUNT -->
		</div>
		<!-- row -->
	</div>
	<!-- container -->
</div>
<!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="active"><a href="/">Home Page</a></li>
				@foreach ($categories as $category)
				<li><a href=" {{ route('category',$category->category) }}">{{$category->category}}</a></li>
				@endforeach
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->
</nav>
<!-- /NAVIGATION -->