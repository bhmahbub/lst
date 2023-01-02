  <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3" style="background-color: #0D4C92;">
    <div class="container ">
      <a class="navbar-brand d-flex align-items-center" href="{{'/'}}">
        <img id="court_img" src="{{asset('img/logo.png')}}" height="45px;" style="margin-right: 10px;">
        <span id="court_title_sm">এলএসটি, মৌলভীবাজার</span><span id="court_title">ল্যান্ড সার্ভে ট্রাইব্যুনাল, মৌলভীবাজার</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex text-end text-dark">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ">
            </li>
            <li class="nav-item">
              <a class="nav-link text-white active" aria-current="page" href="{{'/'}}">হোমপেজ</a>
            </li>
            <li class="nav-item">
              <a href="{{'causelist'}}" class="nav-link text-white">কজ্বলিষ্ট</a>
            </li>
            <li class="nav-item">
              <a href="{{'/#search_area'}}"  class="nav-link text-white">মামলার তথ্য</a>
            </li>
            <li class="nav-item">
              <a href="{{'/#search_area'}}" class="nav-link text-white">রায়/আদেশ</a>
            </li>

            @auth('admin')
            <li class="nav-item dropdown">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                এডমিন এরিয়া
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href=" {{ route('admin.dashboard') }} " class="dropdown-item mx-1">ড্যাশবোর্ড</a>
                </li>
                <li class="dropdown-divider mx-3"></li>
                <li>
                  <form id="admin.logout-form" action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('admin.logout-form').submit();" class="dropdown-item mx-1">লগ আউট</a>
                  </form>

                </li>
              </ul>
            </li>
            @else
            @if (Route::has('login'))

            @auth
            <li class="nav-item dropdown">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ইউজার এরিয়া
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{ url('/dashboard') }}" class="dropdown-item mx-1">ড্যাশবোর্ড</a>
                </li>
                <li class="dropdown-divider mx-3"></li>
                <li>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item mx-1">লগ আউট</a>
                  </form>

                </li>
              </ul>
            </li>
            @else

            <li class="nav-item dropdown">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ইউজার এরিয়া
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{ route('login') }}" class="dropdown-item mx-1">লগইন</a>
                </li>

                @if (Route::has('register'))
                <li class="dropdown-divider mx-3"></li>
                <li><a href="{{ route('register') }}" class="dropdown-item mx-1">রেজিস্টার</a></li>
                @endif
              </ul>
            </li>

            @endauth

            @endif

            @endauth

          </ul>

        </div>
      </div>
    </div>
  </nav>
