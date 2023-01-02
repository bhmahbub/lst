<!DOCTYPE html>
<html lang="en">

<head>
  <title>কজ্বলিষ্ট | এলএসটি, মৌলভীবাজার</title>
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

  <!-- MENU BAR -->
  @php
  function trans2bn($number)
  {
      $search_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'LST', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Under Trial', 'Disposed'];
      $replace_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'এলএসটি', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর', 'বিচারাধীন', 'নিষ্পত্তিকৃত'];

      $bn_number = str_replace($search_array, $replace_array, $number);

      return $bn_number;
  }

@endphp

@include('homepage_includes.welcome_nav')

         <!-- Latest News -->

         <section class="d-flex justify-content-center align-items-center my-0 shadow" style="background: #59C1BD;">
            <div class="container my-4">

           <div class="row">
               <div class="col-md-12">
                   <div class="d-flex justify-content-between align-items-center breaking-news" style="background: #057a8d; border: 2px solid #ffffcc;">
                       <div class="d-flex flex-row flex-grow-1 flex-fill justify-content-center py-2 px-1 news fw-bolder " style="background: #ffffcc;"><span class="d-flex align-items-center">&nbsp;সর্বশেষ সংবাদ</span></div>
                       <marquee class="news-scroll text-white" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"><span class="dot mx-4"></span>চলতি মাসে এ যাবৎ মোট নিষ্পত্তিকৃত মামলার সংখ্যা {{ trans2bn($disposal_current_month) }} <span class="dot mx-4"></span>চলতি মাসে এ যাবৎ মোট দায়েরকৃত মামলার সংখ্যা {{ trans2bn($filing_current_month) }}<span class="dot mx-4"></span>বিগত মাসে মোট নিষ্পত্তিকৃত মামলার সংখ্যা {{ trans2bn($disposal_last_month) }} <span class="dot mx-4"></span>বিগত মাসে মোট দায়েরকৃত মামলার সংখ্যা {{ trans2bn($filing_last_month) }} </marquee>

                   </div>
               </div>
           </div>

            </div>
       </section>



  <!-- ABOUT -->
  <section class="d-flex justify-content-center align-items-center" style="background: linear-gradient(180deg, #59C1BD 50%, #eee 50%);">
    <div class="container-fluid ">
      <div class="mx-5 my-3">
          <div class="col-md-6 mx-auto card text-center px-3 my-3 shadow">
            <div class="row mx-1">
              <div class="col-sm-6 p-2 my-3" style="background: #057a8d;">
                <div class="p-2" style="border: 1px solid #ffffcc;">
                  <h5 class="mb-0 text-white">কজ্বলিস্ট দেখুন</h5>
                </div>
              </div>
              <div class="col-sm-6 p-2 my-3" style="background: #ffffcc; border: 1px solid #057a8d;">
                <form action="{{'causelist'}}" method="POST">
                  @csrf
                  <input type="text" class="me-2 form-control text-center" style="border-color: #000000;" id="date_of_birth" placeholder="তারিখ" name="cl_date" autocomplete="off" required onchange="this.form.submit();"/>
                </form>
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

      <div class="container">
            <!-- causelist area -->
          <div class="card">
            <div class="card-body text-center">
              <div class="p-3" style="border: 1px solid #057a8d;">


            @include('func')


              <div class="col-md-6 p-2 mb-3 mx-auto card shadow" >
                <div class="p-2" style="border: 1px solid #057a8d;">
                  <h5 class="mb-0">{{ trans2bn(date('d/m/Y', strtotime(str_replace("-", "/", $cl_date)))) }} ইং তারিখের কজ্বলিস্ট</h5>
                </div>
              </div>

            <table class="table table-striped table-bordered table-responsive-sm text-center mb-0">
              <thead class="" style="">
                <th class="bg-success font-weight-normal text-white">ক্রমিক নং</th>
                <th class="bg-success font-weight-normal text-white">মামলার নম্বর</th>
                <th class="bg-success font-weight-normal text-white">কার্যক্রম</th>
                <th class="bg-success font-weight-normal text-white">পরবর্তী তারিখ</th>
                <th class="bg-success font-weight-normal text-white">সংক্ষিপ্ত আদেশ</th>
                <th class="bg-success font-weight-normal text-white">মন্তব্য</th>
              </thead>
              <tbody>
           @foreach ($cl as $i => $dt)
               <tr class="">
                  <td>{{ trans2bn($i+1) }}</td>
                  <td>{{ trans2bn($dt->caseno) }}</td>
                  <td>{{ $dt->c_for }}</td>
                  <td>@if($dt->n_date != '1970-01-01')
                    {{ trans2bn(date('d/m/Y', strtotime(str_replace("-", "/", $dt->n_date)))) }}
                    @else {{ 'প্রযোজ্য নয়' }}
                    @endif
                  </td>
                  <td>{{ $dt->n_for }}</td>
                  <td>{{ $dt->remark }}</td>
                </tr>
            @endforeach
              </tbody>

            </table>


          </div>
            </div>
          </div>
          <!-- //causelist area -->
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
