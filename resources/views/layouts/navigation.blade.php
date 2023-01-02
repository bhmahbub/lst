    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row text-center">
                <li class="nav-item theme-logo">
                    <a href="{{route('dashboard')}}">
                        <img src="{{asset('img/logo.png')}}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{route('dashboard')}}" class="nav-link"> ল্যান্ড সার্ভে ট্রাইব্যুনাল, মৌলভীবাজার </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">

                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                        <div class="text-white"><i class="fa-regular fa-circle-user mx-2"></i>{{ Auth::user()->name }}</div>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <!-- <div class="dropdown-item">
                                <a class="" href="user_profile.html"><i class="fa-regular fa-circle-user mx-2"></i>প্রোফাইল</a>
                            </div> -->
                            <div class="dropdown-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="fa-solid fa-right-from-bracket mx-2"></i>
                                        {{ __('লগ আউট') }}
                                    </a>
                                </form>


                            </div>
                        </div>
                    </div>
                </li>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <div class="page-title">
                            <h3>@yield('pagename')</h3>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->


