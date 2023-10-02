<!DOCTYPE html>
<html>
<head>
	<title>User Register Details.</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body style=" margin: 0px;">
  <center>
    <div style="height:auto; padding:25px; font-family: 'Roboto', sans-serif;">
      <div style="background-color:#17192a; height:100px; padding:20px 10px;">
        <a href="https://www.thetradeinternational.com/" target="_blank" rel="noopener noreferrer"><img src="https://www.thetradeinternational.com/public/img/logo.png" style="max-width:100%; display: inline-block;"></a>
      </div>

      <div style="height: auto; text-align:center; background:#17192a;">   
        <div style="width:80%; background:#fff; padding:30px; text-align:left; display: inline-block; border-top: 5px solid #f8dc77; border-bottom: 5px solid #f8dc77;">
           
          <h4 style="margin:0 0 0; font-size:18px;">Dear <strong>{{ucfirst($userDetail['first_name'])}} {{ucfirst($userDetail['last_name'])}}</strong>,</h4>
          Your account has been created with the following Details:
          <p style="font-size:14px; line-height:24px;"><strong>Email Address : </strong>{{$userDetail['email']}}</p>
          <p style="font-size:14px; line-height:24px;"><strong>Password : </strong>{{$randomString}}</p>
        </div>
      </div>

      <div style="height: auto; padding: 20px; background:#17192a;">
        <center>
          <a href="https://m.facebook.com/TheTradeInternational/" target="_blank" rel="noopener noreferrer" class="fa fa-facebook" style="margin: 10px;"><img src="https://www.thetradeinternational.com/public/img/facebook-icon.png"></a>
          <a href="https://twitter.com/TheTradeInt/" target="_blank" rel="noopener noreferrer" class="fa fa-twitter" style="margin: 10px;"><img src="https://www.thetradeinternational.com/public/img/twitter-icon.png"></a>
          <a href="https://linkedin.com/company/thetradeinternational/" rel="noopener noreferrer" target="_blank" class="fa fa-linkedin" style="margin: 10px;"><img src="https://www.thetradeinternational.com/public/img/linkedin-icon.png"></a>
          <!-- <a href="javascript:void(0)" class="fa fa-youtube-play"></a> -->
          <a href="https://instagram.com/TheTradeInternational/" target="_blank" rel="noopener noreferrer" class="fa fa-instagram" style="margin: 10px;"><img src="https://www.thetradeinternational.com/public/img/instagram-icon.png"></a>
        </center>
      </div>
    </div>
  </center>
</body>
</html>