<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>The Trade Fair</title>
  <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset('css/jquery.lbt-lightbox.min.css')}}">

  <!-- fonts Css -->
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.min.css')}}">
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/init-custom.css')}}" rel="stylesheet">
  <link href="{{asset('css/custom.css')}}" rel="stylesheet">
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{asset('css/validationEngine.jquery.css')}}">

  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/jquery.validationEngine.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jquery.validationEngine-en.js')}}"></script>


  <script src="{{asset('js/jquery.star-rating-svg.js')}}"></script>


  <?php if (isset($meta_datas)) { ?>


    <title><?php echo $meta_datas['meta_title']; ?></title>
    <meta name="description" content="<?php echo $meta_datas['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $meta_datas['meta_keywords']; ?>">
    <link rel="canonical" href="<?php echo ($meta_datas['canonical_url']) ? $meta_datas['canonical_url'] : ''; ?>" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $meta_datas['meta_title']; ?>" />
    <meta property="og:url" name="og-url" content="<?php echo ($meta_datas['canonical_url']) ? $meta_datas['canonical_url'] : ''; ?>" />
    <meta property="og:site_name" content="The Trade Fair" />

    <meta property="og:description" content="<?php echo $meta_datas['meta_description']; ?>" />
    <meta property="og:image" content="<?php echo env('APP_URL') . 'public/images/' . $meta_datas['image']; ?>" />
    <meta property="fb:admins" content="The Trade Fair" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@TheTradeInt">
    <meta name="twitter:title" content="<?php echo $meta_datas['meta_title']; ?>">
    <meta name="twitter:description" content="<?php echo $meta_datas['meta_description']; ?>">

    <meta name="twitter:image" content="<?php echo env('APP_URL') . 'public/images/' . $meta_datas['image']; ?>" />


  <?php } ?>
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
    let tooltipelements = document.querySelectorAll("[data-bs-toggle='tooltip']");
    tooltipelements.forEach((el) => {
      new bootstrap.Tooltip(el);
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
  <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/room-filter.js')}}"></script>

  <script async src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="{{ asset('js/sweetalert2@10.js') }}"></script>

  <script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>

  <script>
    $(document).ready(function() {

      $("#photos-slider").owlCarousel({
        margin: 0,
        loop: false,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: false,
        items: 3,
        slideBy: 3,
        autoplay: false,
        smartSpeed: 500,
        autoplayTimeout: 500,
        responsiveClass: true,
        responsive: {
          0: {
            items: 3
          }
        },
      });
    });
  </script>



</body>

</html>