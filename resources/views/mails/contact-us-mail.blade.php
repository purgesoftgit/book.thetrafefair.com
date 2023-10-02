<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body style="background:#fff;">


	<div style="margin:0; padding:0px; font-family: 'Roboto', sans-serif;">

		<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width:600px; background:#fffae7;">
			<tbody>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tbody>
								<tr>
									<td align="center" valign="top" style="background:#333333;"></td>
									<td align="center" valign="top" style="background:#333333;">
										<a href="https://www.thetradeinternational.com/" style="display: inline-block;"><img src="https://www.thetradeinternational.com/public/email-img/logo.png" alt="Logo"></a>
									</td>
									<td align="center" valign="top" style="background:#333333;"></td>
								</tr>
								<tr>
									<td style="border-bottom:4px solid #fae17c"></td>
									<td style="border-bottom:4px solid #fae17c"></td>
									<td style="border-bottom:4px solid #fae17c"></td>
								</tr>

								<tr>
									<td width="20px"></td>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
											<tbody>

												<tr>
													<td height="25"></td>
												</tr>

												<tr>
													<td>
														<table width="100%" border="0" cellspacing="0" cellpadding="0" valign="top">
															<tbody>
																<tr>
																	<td width="270px" valign="top">
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
																			<tbody>
																				<tr>
																					<td>You have received query from <strong>@if($contact->first_name) {{$contact->first_name}} {{$contact->last_name}} @else {{$contact->name}} @endif</strong> .
																					</td>
																				</tr>
																				
																				@if(!empty($contact) && $contact != null)
																					 
																					<tr>
																						<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">E-mail</td>
																					</tr>
																					<tr>
																						<td style="font-size:14px; color: #666; padding-bottom:12px; border-bottom:1px solid #d9d9d9;"> {{$contact->email}}</td>
																					</tr>

																					<tr>
																						<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">Phone</td>
																					</tr>
																					<tr>
																						<td style="font-size:14px; color: #666; padding-bottom:12px; border-bottom:1px solid #d9d9d9;">@if($contact->phone_number) {{$contact->phone_number}} @else {{$contact->phone}} @endif</td>
																					</tr>

																					@if($contact->how_contact != null)
																						<tr>
																							<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">Contact By</td>
																						</tr>
																						<tr>
																							<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">{{$contact->how_contact}}</td>
																						</tr>
																						<tr>
																							<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">Time of Travel</td>
																						</tr>
																						<tr>
																							<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">{{$contact->time_of_travel}}</td>
																						</tr>
																					@endif

																					@if($contact->subject != null)
																						<tr>
																							<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">Subject</td>
																						</tr>
																						<tr>
																							<td style="font-size:14px;line-height:22px;color:#666">{{$contact->subject}}</td>
																						</tr>
																					@endif
																					@if($contact->compny != null)
																						<tr>
																							<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">Company</td>
																						</tr>
																						<tr>
																							<td style="font-size:14px;line-height:22px;color:#666">{{$contact->compny}}</td>
																						</tr>
																					@endif
																					@if($contact->booking_purpose != null)
																						<tr>
																							<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">Booking Purpose</td>
																						</tr>
																						<tr>
																							<td style="font-size:14px;line-height:22px;color:#666">{{$contact->booking_purpose}}</td>
																						</tr>
																					@endif
																					
																				@endif
																			</tbody>
																		</table>	
																	</td>

																	<td width="20"></td>

																	<td width="270px">
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
																			<tbody>
																				<tr>
																					<td style="font-size:15px; font-weight:500; padding:12px 0 5px;">Message</td>
																				</tr>
																				<tr>
																					<td style="font-size:14px;line-height:22px;color:#666">{{$contact->message}}</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
 
											</tbody>
										</table>
									</td>
									<td width="20px"></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>


				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" height="285px" style=" background:url(https://www.thetradeinternational.com/public/email-img/contact-bg.png) no-repeat center bottom; text-align: center;">
							<tbody>
								<tr>
									<td height="150"></td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
											<tbody>
												<tr>
													<td width="5%"></td>
													<td align="center">
														<a href="https://m.facebook.com/TheTradeInternational/"><img src="https://www.thetradeinternational.com/public/email-img/NewFacebook.png" style="max-width:25px; max-height:25px;"></a>

														<span style="width:3px; display: inline-block;"></span>

														<a href="https://twitter.com/TheTradeInt/"><img src="https://www.thetradeinternational.com/public/email-img/NewTwitter.png" style="max-width:25px; max-height:25px;"></a>

														<span style="width:3px; display: inline-block;"></span>

														<a href="https://linkedin.com/company/thetradeinternational/"><img src="https://www.thetradeinternational.com/public/email-img/linkedin.png" style="max-width:25px; max-height:25px;"></a>
														
														<span style="width:3px; display: inline-block;"></span>

														<a href="https://instagram.com/TheTradeInternational/"><img src="https://www.thetradeinternational.com/public/email-img/NewInstagram.png" style="max-width:25px; max-height:25px;"></a>
													</td>
													<td width="5%"></td>
													
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td align="center">
										<p style="font-size:13px; line-height:18px; margin:0; color:#898989;">Jaipur - Ajmer Expy, Near Riico(Bagru), Jaipur, Rajasthan - 303007, India</p>
									</td>
								</tr>
								<tr>
									<td height="60"></td>
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