<nav class="navbar">
    <a href="#" class="navbar-logo">
      <img src="{{ asset('images/2-logo.png') }}" alt="Logo">
      Cafe<span>Compass</span>.</a>

    <div class="navbar-nav">
      <a href="#home">Home</a>
      <a href="#timeline">How to</a>
      <a href="#coffeshop">Popular</a>
      <a href="#FAQ">FAQ</a>
    </div>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-black-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
      @if (Route::has('login'))
          <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
              @auth
                  <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
              @else
                  <a href="{{ route('login') }}" class="btn-login-register">Log in</a>

                  @if (Route::has('register'))
                      <a href="{{ route('register') }}" class="btn-login-register ml-4">Register</a>
                  @endif
              @endauth
          </div>
      @endif
  </div>
     <div class="navbar-extra">
      {{-- <a href="#" id="search-button"><i data-feather="search"></i></a> --}}
      <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>

    <!-- Search Form start -->
    {{-- <div class="search-form">
      <input type="search" id="search-box" placeholder="search here..." />
      <label for="search-box"><i data-feather="search"></i></label>
    </div> --}}
    <!-- Search Form end -->
  </nav>

