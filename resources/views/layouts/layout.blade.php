<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset('css/jquery.lbt-lightbox.min.css')}}">

  <!-- fonts Css -->
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{asset('css/validationEngine.jquery.css')}}">

  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/jquery.validationEngine.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.validationEngine-en.js')}}"></script>


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


  <title>Booking Engine - The Trade Fair</title>
  <meta name="description" content="Booking Engine - The Trade Fair">
  <meta name="keywords" content="Booking Engine - The Trade Fair">
  <link rel="canonical" href="{{ url('/') }}" />

  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Booking Engine - The Trade Fair" />
  <meta property="og:url" name="og-url" content="{{ url('/') }}" />
  <meta property="og:site_name" content="The Trade Fair" />

  <meta property="og:description" content="Booking Engine - The Trade Fair" />
  <meta property="og:image" content="{{asset('img/gallery-3.jpg')}}" />
  <meta property="fb:admins" content="The Trade Fair" />
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Booking Engine - The Trade Fair">
  <meta name="twitter:description" content="Booking Engine - The Trade Fair">

  <meta name="twitter:image" content="{{asset('img/gallery-3.jpg')}}" />

</head>

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

  <script async src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="{{ asset('js/sweetalert2@10.js') }}"></script>




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