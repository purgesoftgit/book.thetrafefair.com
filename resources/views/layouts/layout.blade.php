<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


  <meta property="og:url" content="{{ env('APP_URL') }}" />
  <meta property="og:title" content="Your Page Title" />
  <meta property="og:description" content="A brief summary of your page" />
  
  <title>The Trade Fair</title>
  <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}">

 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset('css/jquery.lbt-lightbox.min.css')}}">

  <!-- fonts Css -->
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet">

  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

  <style>
    /*hide number input spin box */
    input[type="number"]::-webkit-inner-spin-button {
      display: none;
    }

    /* Fallback for other browsers */
    input[type="number"] {
      appearance: textfield;
      -moz-appearance: textfield;
      -webkit-appearance: textfield;
    }
  </style>
<body>
  @yield('content')


   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="{{asset('js/jquery.lbt-lightbox.min.js')}}"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

  <script type="text/javascript">
    $('#gallery').lbtLightBox({
      qtd_pagination: 6,
      pagination_width: "160px",
      pagination_height: "160px",
      custom_children: ".box img",
      captions: true,
      captions_selector: ".caption p",
    });
  </script>

  <script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/room-filter.js')}}"></script>

  <!-- Slider Script Start -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("--").owlCarousel({
        margin: 24,
        loop: true,
        nav: false,
        dots: false,
        items: 6,
        autoplay: true,
        smartSpeed: 2000,
        autoplayTimeout: 4000,
        responsiveClass: true,
        responsive: {
          0: {
            margin: 0,
            items: 1
          },
          600: {
            margin: 0,
            items: 1
          },
          992: {
            margin: 15,
            items: 2
          },
          1200: {
            items: 3
          },
        },
      });
    });
  </script>

  <script type="text/javascript">
    $(".indec-button").on("click", function() {

      var $button = $(this);
      var oldValue = $button.parent().find("input").val();

      if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
      } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
          var newVal = parseFloat(oldValue) - 1;
        } else {
          newVal = 0;
        }
      }

      $button.parent().find("input").val(newVal);

    });
  </script>
  <script type="text/javascript">
    let tooltipelements = document.querySelectorAll("[data-bs-toggle='tooltip']");
    tooltipelements.forEach((el) => {
      new bootstrap.Tooltip(el);
    });
  </script>
</body>

</html>