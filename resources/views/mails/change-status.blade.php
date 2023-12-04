<!DOCTYPE html>
<html>
<head>
	<title>Table Reservation Confirmation Mail</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body style="background:#fff;">
	<div style="margin:0; padding:0px; font-family: 'Roboto', sans-serif;">
		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width:600px; background: #fffae7;">
			<tbody>
				<tr>
					<td align="left" valign="top" style="background:url(<?php if($change->type_of_booking == 0){ echo 'https://www.thetradeinternational.com/public/email-img/reservation-bar-bg.jpg';}else if($change->type_of_booking == 1){ echo 'https://www.thetradeinternational.com/public/email-img/reservation-restaurant-bg-new.jpg'; }else{ echo 'https://www.thetradeinternational.com/public/email-img/reservation-meeting-bg.jpg';} ?>) no-repeat center center;" height="300">
						<a href="https://www.thetradeinternational.com" style="padding:8px 0 0 8px; display: inline-block;"><img src="https://www.thetradeinternational.com/public/email-img/logo-logo.png"></a>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tbody>
								<tr>
									<td width="5%" height="30"></td>
									<td height="30"></td>
									<td width="5%" height="30"></td>
								</tr>
 			 
								<tr>
									<td width="5%"></td>
									<td align="center" style="">
										<h3 style="font-size:24px; text-transform: uppercase; color:#474956; margin:0;">
										@if($change->status == 1)
											Confirmation for @if($change->type_of_booking == 0) Bar @elseif($change->type_of_booking == 1) Restaurant @else Meeting @endif Table
										@else
											Cancellation for @if($change->type_of_booking == 0) Bar @elseif($change->type_of_booking == 1) Restaurant @else Meeting @endif Table
										@endif</h3>
									</td>
									<td width="5%"></td>
								</tr>
								<tr>
									<td width="5%" height="20"></td>
									<td height="20"></td>
									<td width="5%" height="20"></td>
								</tr>

								<tr>
									<td width="5%"></td>
									<td style="">
										<p style="font-size:14px; line-height:22px; margin:0;"></p>
										<p style="font-size:14px; text-align: center; line-height:22px; margin:0;">
										@if($change->status == 1)
											Your @if($change->type_of_booking == 0) Bar @elseif($change->type_of_booking == 1) Restaurant @else Meeting @endif Reservation At Hotel The Trade International on the {{ date('d-m-Y',strtotime($change->date)) }} At {{ date('h:i A',strtotime($change->time)) }} For {{$change->person}} People In now Confirmed, HAVE A GREAT TIME
										@else
											Your @if($change->type_of_booking == 0) Bar @elseif($change->type_of_booking == 1) Restaurant @else Meeting @endif Reservation At Hotel The Trade International on the {{ date('d-m-Y',strtotime($change->date)) }} At {{ date('h:i A',strtotime($change->time)) }} For {{$change->person}} People In Cancelled, HAVE A GREAT TIME
										@endif
										</p>
									</td>
									<td width="5%"></td>
								</tr>
								<tr>
									<td width="5%" height="30"></td>
									<td height="30"></td>
									<td width="5%" height="30"></td>
								</tr>

								<tr>
									<td width="5%" height="20" style="border-top:1px solid #d9d9d9"></td>
									<td height="20" style="border-top:1px solid #d9d9d9"></td>
									<td width="5%" height="20" style="border-top:1px solid #d9d9d9"></td>
								</tr>

								<tr>
									<td width="5%" style=""></td>
									<td align="center" style="">
										<a href="https://m.facebook.com/TheTradeInternational/"><img src="https://www.thetradeinternational.com/public/email-img/NewFacebook.png" style="max-width:25px; max-height:25px;"></a>
										<span style="width:3px; display: inline-block;"></span>

										<a href="https://twitter.com/TheTradeInt/"><img src="https://www.thetradeinternational.com/public/email-img/NewTwitter.png" style="max-width:25px; max-height:25px;"></a>
										<span style="width:3px; display: inline-block;"></span>

										<a href="https://linkedin.com/company/thetradeinternational/"><img src="https://www.thetradeinternational.com/public/email-img/linkedin.png" style="max-width:25px; max-height:25px;"></a>
                    					<span style="width:3px; display: inline-block;"></span>

										<a href="https://instagram.com/TheTradeInternational/"><img src="https://www.thetradeinternational.com/public/email-img/NewInstagram.png" style="max-width:25px; max-height:25px;"></a>
									</td>
									<td width="5%" style=""></td>
								</tr>

								<tr>
									<td width="5%" height="5" style=""></td>
									<td height="5" style=""></td>
									<td width="5%" height="5" style=""></td>
								</tr>

								<tr>
									<td width="5%" style=""></td>
									<td align="center" style="">
										<p style="font-size:13px; line-height:18px; margin:0; color:#898989;">Jaipur - Ajmer Expy, Near Riico(Bagru), Jaipur, Rajasthan - 303007, India</p>
									</td>
									<td width="5%" style=""></td>
								</tr>
								<tr>
									<td width="5%" height="25" style=""></td>
									<td height="25" style=""></td>
									<td width="5%" height="25" style=""></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>