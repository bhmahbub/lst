<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('adminpagename') | এলএসটি, মৌলভীবাজার</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}" />
    <link href="{{ asset('userarea/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('userarea/assets/js/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/fe0913d04b.js"></script>




    <!-- dataTables css -->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

    <style type="text/css">
        body {
            background: #eee
        }

        .news {
            width: 160px
        }

        .news-scroll a {
            text-decoration: none
        }

        .dot {
            height: 10px;
            width: 10px;
            background-color: #ffffcc;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
    <link href="{{ asset('userarea/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        .layout-px-spacing {
            min-height: calc(100vh - 166px) !important;
        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body style="font-family: 'SolaimanLipi', Arial, sans-serif !important;">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    @include('admin.layouts.navigation')
    @include('func')


    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container mb-3" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">
                    {{-- <li class="menu">
                        <a href="{{ route('admin.all') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fa-solid fa-house mr-2"></i>
                                <span> all</span>
                            </div>
                        </a>
                    </li> --}}

                    <li class="menu">
                        <a href="{{ route('homepage') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fa-solid fa-house mr-2"></i>
                                <span> হোম পেজ</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fa-solid fa-desktop mr-2"></i>
                                <span> ড্যাশবোর্ড</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="#submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fa-solid fa-file-pen mr-2"></i>
                                <span>মামলা সংক্রান্ত</span>
                            </div>
                            <div>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </a>
                        <ul class="collapse my-2" id="submenu" data-parent="#accordionExample">
                            <li class="mt-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('cases.index') }}"><i
                                        class="fa-regular fa-calendar-plus mr-2"></i><span>মামলা যুক্তকরণ </span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('admin.all-cases') }}"><i
                                        class="fa-solid fa-layer-group mr-2"></i><span>বছর ভিত্তিক মামলা</span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('admin.allcases') }}"><i
                                        class="fa-solid fa-suitcase mr-2"></i><span>বিচারাধীন সকল মামলা</span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;"
                                    href="{{ route('admin.alldisposed') }}"><i
                                        class="fa-solid fa-lock mr-2"></i></i><span>নিষ্পত্তিকৃত সকল মামলা</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fa-solid fa-list-ul mr-2"></i>
                                <span>কজ্বলিস্ট সংক্রান্ত</span>
                            </div>
                            <div>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </a>
                        <ul class="collapse my-2" id="submenu1" data-parent="#accordionExample">
                            <li class="mt-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('admin.causelist') }}"><i
                                        class="fa-regular fa-calendar-plus mr-2"></i><span>কজ্বলিস্ট যুক্তকরণ
                                    </span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('causelistOf') }}"><i
                                        class="fa-solid fa-layer-group mr-2"></i><span>তারিখ ভিত্তিক
                                        কজ্বলিস্ট</span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;"
                                    href="{{ route('causelist-update') }}"><i
                                        class="fa-solid fa-suitcase mr-2"></i><span>কজ্বলিস্ট আপডেট</span></a>
                            </li>

                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;"
                                    href="{{ route('causelist-pending') }}"><i
                                        class="fa-regular fa-circle-xmark mr-2"></i><span>কজ্বলিস্ট পেন্ডিং</span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;"
                                    href="{{ route('manage-disposed') }}"><i
                                        class="fa-regular fa-circle-check mr-2"></i><span>নিষ্পত্তি
                                        ব্যবস্থাপনা</span></a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="menu">
                        <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fa-solid fa-chart-simple mr-2"></i>
                                <span>রিপোর্ট সংক্রান্ত</span>
                            </div>
                            <div>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </a>
                        <ul class="collapse my-2" id="submenu2" data-parent="#accordionExample">
                            <li class="mt-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('cases.index') }}"><i class="fa-regular fa-calendar-plus mx-2"></i><span>রিপোর্ট যুক্তকরণ </span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('admin.all-cases' )}}"><i class="fa-solid fa-layer-group mx-2"></i><span>মাস ভিত্তিক রিপোর্ট</span></a>
                            </li>
                            <li class="dropdown-divider mx-3"></li>
                            <li class="mb-1">
                                <a style="text-decoration: none; color: #000;" href="{{ route('admin.allcases' )}}"><i class="fa-solid fa-suitcase mx-2"></i><span>রিপোর্ট আপডেট</span></a>
                            </li>
                        </ul>
                    </li> --}}


                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing mt-3">


                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                        @yield('adminmain')

                    </div>



                </div>

            </div>

        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->


    <div class="card pt-3 pb-1 shadow fixed-bottom" style="background:#fff;">
        <div class="row mx-5 justify-content-between">

            <div class="">

                <h6 class="text-dark">&copy; <?php echo en2bnNumber(date('Y')); ?><a class="" href="//supremecourt.gov.bd"
                        style="text-decoration: none;" target="_blank"> এলএসটি, মৌলভীবাজার</a></h6>

            </div>

            <div class="d-flex">

                <h6>ডেভেলপমেন্ট:<a style="text-decoration: none;" target="_blank" href="details.php"> মাহমুদ</a></h6>

            </div>

        </div>

    </div>




    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- tabledit -->
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
    <script src="{{ asset('userarea/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('userarea/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('userarea/assets/js/custom.js') }}"></script>

    <!-- dataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').dataTable({
                aLengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],

            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert").slideUp(500);
            });
        });
    </script>



    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>
