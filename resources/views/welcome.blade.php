<!DOCTYPE html>
<html lang="en">

<head>
  <title>এলএসটি, মৌলভীবাজার</title>
  <link rel="icon" type="image/x-icon" href="{{asset('img/logo.png')}}"/>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/fe0913d04b.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <!-- bangla date -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="{{ asset('bncalender/jquery-ui-bangla.js') }} "></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
    <script>
        $(function () {
            var fullmonth_array = $.datepicker.regional['bn-BD'].monthNames;
            $.datepicker.setDefaults($.datepicker.regional['bn-BD']);
            $("#date_of_birth").datepicker({
                dateFormat: "dd/mm/yy",
                monthNamesShort: fullmonth_array,
                changeMonth: true,
                changeYear: true
            }, $.datepicker.regional['bn-BD']);
        });
    </script>
    <!--Bangla date script-->
    <script type="text/javascript">
        $(document).on("change", "#date_of_birth", function () {
            var dateArr = $(this).val().split('/');
            var banglaDate = mrt(dateArr[0]) + '/' + mrt(dateArr[1]) + '/' + mrt(dateArr[2]);
            $(this).val(banglaDate);
        });
    </script>


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
    #court_title_sm{
            /* font-size: 15px;*/
            display: none;
        }

    @media screen and (max-width: 480px) {
        #court_title{
            /* font-size: 15px;*/
            display: none;
        }
        #court_title_sm{
            display: block;
        }
        #court_img{
            height: 40px;
        }
    }
  </style>



</head>

<body style="font-family: 'SolaimanLipi', Arial, sans-serif !important;">
@include('func')

  <!-- MENU BAR -->

@include('homepage_includes.welcome_nav')

         <!-- Latest News -->

@include('homepage_includes.welcome_scroll')


  <!-- HERO -->
  <section class="d-flex justify-content-center align-items-center" style="background: #59C1BD;">
    <div class="container">

      <div class="mx-3 my-3">
        <div class="p-4 my-3 text-center" style="border: 2px solid #ffffcc;">

          <h3 class="text-white mb-3" style="text-shadow: 1px 1px #000000;"><b>মামলার প্রয়োজনীয় সকল তথ্যাদি</b></h3>
          <h4 class="text-white mb-3">এক ঠিকানায়...</h4>

          <h5 class="text-white mb-0"><b><span style="text-shadow: 1px 1px #000000;">কজ্বলিস্ট</span> | <span style="text-shadow: 1px 1px #000000;">মামলার তথ্য</span> | <span style="text-shadow: 1px 1px #000000;">রায়/আদেশ</span></b></h5>
        </div>
      </div>
    </div>


  </section>

  <!-- ABOUT -->
  <section class="d-flex justify-content-center align-items-center" style="background: linear-gradient(180deg, #59C1BD 50%, #eee 50%);">
    <div class="container-fluid ">
      <div class="mx-5 row my-3">
        <div class="mx-auto p-2 shadow text-center col-lg-2 col-md-3 col-sm-4 col-7  my-2 rounded-circle" style="background: #FFFFFF;">
          <div class="p-3 rounded-circle" style="border: 2px solid #057a8d;">
            <div class="card bg-transparent border-0 mt-2">
              <div class="text-center">
                <h6 class="" data-aos="fade-up"><b>বিগত মাসে</b></h6>
                <h5 class="" data-aos="fade-up"><b>মোট প্রাপ্তি</b></h5>
                <h5 class="" data-aos="fade-up"><b>{{ en2bnNumber($filing_last_month) }}</b></h5>
              </div>
            </div>
          </div>
        </div>

        <div class="mx-auto p-2 shadow text-center col-lg-2 col-md-3 col-sm-4 col-7 my-2 rounded-circle" style="background: #FFFFFF;">
          <div class="p-3 rounded-circle" style="border: 2px solid #057a8d;">
            <div class="card bg-transparent border-0 mt-2">
              <div class="text-center">
                <h6 class="" data-aos="fade-up"><b>বিগত মাসে</b></h6>
                <h5 class="" data-aos="fade-up"><b>মোট নিষ্পত্তি</b></h5>
                <h5 class="" data-aos="fade-up"><b>{{ en2bnNumber($disposal_last_month) }}</b></h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mx-auto p-2 shadow text-center col-lg-2 col-md-3 col-sm-4 col-7 my-2 rounded-circle" style="background: #FFFFFF;">
          <div class="p-3 rounded-circle" style="border: 2px solid #057a8d;">
            <div class="card bg-transparent border-0 mt-2">
              <div class="text-center">
                <h6 class="" data-aos="fade-up"><b>বর্তমানে মোট</b></h6>
                <h5 class="" data-aos="fade-up"><b>বিচারাধীন</b></h5>
                <h5 class="" data-aos="fade-up"><b>{{ en2bnNumber($total_under_trial) }}</b></h5>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- End about -->

  <!-- mainbody -->

  <section class="d-flex justify-content-center align-items-center" style="background: #eee;">
    <div class="container my-3">
      <div class="row">
        <div class="col-md-5 col-lg-4">
          <!-- dj -->
          <!-- <div class="row px-3"> -->
            <div class="mx-auto card my-2">
              <div class="card-body text-center">
                  <div class="p-2" style="border: 1px solid #057a8d;">
                    <img src="https://moulvibazar.judiciary.org.bd/sites/default/files/2022-11/pic_0.jpg" height="120" class="p-1 rounded-circle mt-1 mb-2" alt="DJ" style="border: 3px solid #057a8d;">
                    <h6 class="my-1"><b>জনাব আল-মাহমুদ ফায়জুল কবীর</b></h6>
                    <p class="mb-1">জেলা ও দায়রা জজ</p>
                  </div>
              </div>
            </div>
            <!-- //dj -->
            <!-- LST -->
            <div class="mx-auto card my-2">
              <div class="card-body text-center">
                  <div class="p-2" style="border: 1px solid #057a8d;">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgUorPb92qDJg9eNqOo4fmmu7tVdje3TIqyoEmWDR3kNaX6fuSVP7ITvGcCwI50XW8S3TL2lW-9XEawxzB2zJ2eCS-Js0j18VibEBdgnxOfnmzHV5NXsuuuXjhZ7Sx6GJ9GUO90QKlImS3_xGIoI8WPoa4q0LrlIgYHhNa6BUQBDEFPM1xk9qctoE0L/s16000/JDJ.jpg" height="100" class="p-1 rounded-circle mt-1 mb-2" alt="JDJ" style="border: 3px solid #057a8d;">
                    <h6 class="my-1"><b>মোঃ মাহবুবুর রহমান ভূঁঞা</b></h6>
                    <p class="mb-1">বিচারক (যুগ্ম জেলা ও দায়রা জজ)</p>
                  </div>
              </div>
            </div>
          <!-- </div> -->
          <!-- //LST -->
          <!-- Search area -->
          <div id="search_area" class="mx-auto card text-center px-3 my-2">
            <div class="p-2 mt-3 mb-1" style="background: #057a8d;">
              <div class="p-2" style="border: 1px solid #ffffcc;">
                <h4 class="mb-0 text-white">সার্চ এরিয়া</h4>
              </div>
            </div>
            <div class="px-4 py-3 my-1 justify-content-center" style="background: #ffffcc; border: 1px solid #057a8d;">
              <h6 class="mb-2 text-center"><b>তারিখ ভিত্তিক কজ্বলিস্ট</b></h6>
              <form action="{{'causelist'}}" method="POST" class="">
                @csrf
                <input type="text" class="me-2 form-control text-center border-bottom"  id="date_of_birth" placeholder="তারিখ" name="cl_date" autocomplete="off" required onchange="this.form.submit();"/>
                <!-- <div class="my-auto"><b><i class="fa-solid fa-magnifying-glass"></i></b></div>  -->
              </form>
            </div>



            <div class="px-4 py-3 my-1" style="background: #ffffcc; border: 1px solid #057a8d;">

              <h6 class="mb-2"><b>আপনার মামলার তথ্য</b></h6>

              <form class="d-flex" action="{{'details'}}" method="POST">
                @csrf
                <input type="text" class="me-2 form-control text-center" placeholder="নং" name="no" required>
                <select class="form-select form-control text-center me-2" name="year" required >
                  <option selected>বছর</option>
                  <?php
                      for( $year = 2013; $year <= date("Y"); $year ++) {
                    ?>
                  <option value="<?php echo bn2enNumber($year);?>"><?php echo en2bnNumber($year);?></option>
                  <?php

                      }
                    ?>
                </select>
                <button class="p-2 btn btn-sm border-secondary py-0 rounded-circle" name="search_details" type="submit"><b><i class="fa-solid fa-magnifying-glass"></i></b></button>
              </form>
            </div>
            <div class="px-4 py-3 mt-1 mb-3" style="background: #ffffcc; border: 1px solid #057a8d;">
              <h6 class="mb-2"><b>রায়/আদেশ দেখুন</b></h6>
              <form class="d-flex" action="{{'detailOrder'}}" method="POST">
                @csrf
                <input type="text" class="me-2 form-control text-center" placeholder="নং" name="no" required>
                <select class="form-select form-control text-center me-2" name="year" required >
                  <option selected>বছর</option>
                  <?php
                      for( $year = 2013; $year <= date("Y"); $year ++) {
                    ?>
                  <option value="<?php echo bn2enNumber($year);?>"><?php echo en2bnNumber($year);?></option>
                  <?php

                      }
                    ?>
                </select>
                <button class="px-2 btn btn-sm border-secondary py-0 rounded-circle" name="search_details" type="submit"><b><i class="fa-solid fa-magnifying-glass"></i></b></button>
              </form>
            </div>

          </div>
                      <!-- Links -->
            <div class="mx-auto  card my-2">
              <div class="card-body text-center">
                  <div class="p-3" style="border: 1px solid #057a8d;">
                    <h6 class="text-start ms-3 mb-0"><b>গুরুত্বপূর্ণ লিংকসমূহ</b></h6>
                    <hr class="ms-2 my-2">
                    <ul class="text-start mb-0" >
                      <li class="mb-1"><a style="text-decoration: none;" class="text-dark" href="http://www.supremecourt.gov.bd/web/" target="_blank"><b>বাংলাদেশ সুপ্রীম কোর্ট</b></a></li>
                      <li class="my-1"><a style="text-decoration: none;" class="text-dark" href="http://www.judiciary.org.bd" target="_blank"><b>বিচার বিভাগীয় বাতায়ন</b></a></li>
                      <li class="my-1"><a style="text-decoration: none;" class="text-dark" href="http://www.bangladesh.gov.bd" target="_blank"><b>জাতীয় তথ্য বাতায়ন</b></a></li>
                      <li class="my-1"><a style="text-decoration: none;" class="text-dark" href="http://lawjusticediv.gov.bd/" target="_blank"><b>আইন বিচার ও সংসদ বিষয়ক মন্ত্রণালয়</b></a></li>
                      <li class="my-1"><a style="text-decoration: none;" class="text-dark" href="http://www.mopa.gov.bd/bn" target="_blank"><b>জনপ্রশাসন মন্ত্রণালয়</b></a></li>
                      <li class="mt-1"><a style="text-decoration: none;" class="text-dark" href="http://xn--d5by7bap7cc3ici3m.xn--54b7fta0cc/" target="_blank"><b>মুসলিম উত্তরাধিকার ক্যালকুলেটর</b></a></li>
                    </ul>
                  </div>
              </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-8">
            <!-- causelist area -->
          <div class="card my-2">
            <div class="card-body text-center">
                        <div class="p-3" style="border: 1px solid #057a8d;">

            @php
              use Illuminate\Support\Facades\DB;
              $cl_date = db::table('cl_dates')->max('cl_date');
            @endphp

            <div class="card d-flex align-items-center mb-3 p-2 shadow"><h4 class="mb-0">{{en2bnNumber(date('d/m/Y', strtotime(str_replace("-", "/",$cl_date))))}}ইং তারিখের কজ্বলিস্ট</h4></div>

            <table class="table table-bordered table-striped table-responsive text-center mb-0 shadow">
              <thead style="">
                <th class="">ক্রমিক নং</th>
                <th class="">মামলার নম্বর</th>
                <th class="">কার্যক্রম</th>
                <th class="">মন্তব্য</th>
                <!-- <th class="">পরবর্তী তারিখ</th>
                <th class="">সংক্ষিপ্ত আদেশ</th> -->
              </thead>
              <tbody>

            @foreach ($cl as $i => $dt)
               <tr class="">
                  <td>{{ en2bnNumber($i+1) }}</td>
                  <td>{{ en2bnNumber($dt->caseno) }}</td>
                  <td>{{ en2bn($dt->c_for) }}</td>
                  <td>{{ en2bnNumber($dt->remark) }}</td>
                </tr>

            @endforeach


@php
function en2bn($number){
    $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "&","LST", "Admission hearing", "SR","Step for died party", "Step","WS", "Issue Frame", "FPH","PH", "Petition", "Arguement", "Judgement", "Necessary Paper Submission", "Ex-parte", "Hearing on Legal Ground", "Hearing", "hearing", "Order", "Question", "Compromise", "January","February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "Under Trial","Further");
    $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "ও","এলএসটি", "রক্ষণীয়তা শুনানী","সমন ফেরত","মৃত ব্যক্তির প্রতিকার","প্রতিকার",  "জবাব দাখিল", "ইস্যু গঠন", "পরবর্তী চুড়ান্ত শুনানী", "চুড়ান্ত শুনানী", "দরখাস্ত", "যুক্তিতর্ক", "রায় প্রচার", "প্রয়োজনীয় কাগজাত দাখিল", "একতরফা","আইনগত শুনানী", "শুনানী", "শুনানী", "আদেশ", "প্রশ্নোত্তর দাখিল", "সোলেনামা সংক্রান্ত", "জানুয়ারি","ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর", "বিচারাধীন", "পরবর্তী");

      $bn_number = str_replace($search_array, $replace_array, $number);

      return $bn_number;
    }
@endphp
              </tbody>

            </table>
          </div>
            </div>
          </div>
          <!-- //causelist area -->
        </div>
      </div>
    </div>
  </section>
  <!-- end mainbody -->

<!-- footer -->

@include('homepage_includes.welcome_foot')
<!-- end footer -->
        <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
