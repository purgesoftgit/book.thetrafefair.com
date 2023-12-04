<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel The Trade Fair') }}</title>

    <!-- App favicon -->
    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/gif" sizes="16x16">

    <!-- Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Rancho&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/ui-darkness/jquery-ui.css"> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

  
   
    <!-- spinner bootstrap cdn start -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- spinner bootstrap cdn end -->


    <link href="{{asset('css/dashboard/dropify.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>

    <!-- daterange picker css cdn-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


    <!-- mulitple imgage cdns -->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>


    <script type="text/javascript">
      jQuery(function ($) {
        $(".sidebar-dropdown > a").click(function() {
          $(".sidebar-submenu").slideUp(300);
          if ( $(this).parent().hasClass("active") ) {
            $(".sidebar-dropdown").removeClass("active");
          $(this).parent().removeClass("active");
        } else {
          $(".sidebar-dropdown").removeClass("active");
          $(this).next(".sidebar-submenu").slideDown(300);
          $(this).parent().addClass("active");
        }
      });
      });
 
    </script>
     
    
    <script type="text/javascript">
    $(document).ready(function(){
        if($(window).width() <= 1680) {
          $('#app .chiller-theme').removeClass("toggled")
        }
        else {
          $('#app .chiller-theme').addClass("toggled")
        }
         $('#app .chiller-theme').show()
       
    });

    </script> 

</head>
<body>
    <div id="app" style="width:100%;">
        @yield('content')
    </div>
      <!-- js -->


<!-- <script src="{{asset('js/dashboard/jquery-3.4.1.slim.min.js')}}"></script> -->
<script src="{{asset('js/dashboard/popper.min.js')}}"></script>
<script src="{{asset('js/dashboard/bootstrap.min.js')}}"></script>
<script src="{{asset('js/dashboard/all.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- crop image cdns -->
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>
      

<!-- multiple imgae cdns -->
{{-- <script  type="text/javascript" src="{{asset('Multiple-Image-Picker-jQuery-Spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script> --}}
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ asset('/js/multiple-datatable-data.js') }}"></script>

<!-- daterange picker js cdn-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

</body>
</html>
