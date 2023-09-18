<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>The Trade Fair</title>
  <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
  <!-- <link type="text/css" rel="stylesheet" href="{{asset('css/jssocials.min.css')}}" /> -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/jssocials.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('css/jssocials-theme-classic.css')}}" />
  
  <style>
    /*hide number input spin box */
    input[type="number"]::-webkit-inner-spin-button {
       display: none;
    }
 
    / Fallback for other browsers /
    input[type="number"] {
		appearance: textfield;
		-moz-appearance: textfield;
		-webkit-appearance: textfield;
	 }

 </style>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 
  <?php if(isset($meta_datas)){ ?>
    
    
    <title><?php echo $meta_datas['meta_title']; ?></title>
    <meta name="description" content="<?php echo $meta_datas['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $meta_datas['meta_keywords']; ?>">
    <link rel="canonical" href="<?php echo ($meta_datas['canonical_url']) ? $meta_datas['canonical_url'] : ''; ?>" />
      
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $meta_datas['meta_title']; ?>"/>
    <meta property="og:url" name="og-url" content="<?php echo ($meta_datas['canonical_url']) ? $meta_datas['canonical_url'] : ''; ?>" />
    <meta property="og:site_name" content="The Trade Fair" />
    
    <meta property="og:description" content="<?php echo $meta_datas['meta_description']; ?>" /> 
    <meta property="og:image" content="<?php echo env('APP_URL').'public/images/'.$meta_datas['image']; ?>" />
    <meta property="fb:admins" content="The Trade Fair" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@TheTradeInt">
    <meta name="twitter:title" content="<?php echo $meta_datas['meta_title']; ?>">
    <meta name="twitter:description" content="<?php echo $meta_datas['meta_description']; ?>">
    
    <meta name="twitter:image" content="<?php echo env('APP_URL').'public/images/'.$meta_datas['image']; ?>"/>

      
  <?php } ?>

  
<body>

@yield('content')
    

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <!-- <script type="text/javascript" src="js/custom.js"></script> -->
  <script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>

  {{-- //sweet alert cdn --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script defer type="text/javascript" src="{{asset('js/gallery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript" src="{{asset('js/mp.mansory.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jssocials.min.js')}}"></script>

<!-- room filter js -->
<script type="text/javascript" src="{{asset('js/room-filter.js')}}"></script>


</body>
</html>