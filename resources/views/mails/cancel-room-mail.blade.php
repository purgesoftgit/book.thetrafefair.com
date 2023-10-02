<!DOCTYPE html>
<html>
<body style=" margin: 0px;">
	<div style="background:#ffffff;margin:0;padding:0px;padding:10px 0px 10px 0px" bgcolor="#FFFFFF">
	<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width:600px;border:0px solid #b6b6b7">
		<tbody>
			<?php
				$checkout_form_data = !empty($trans_data) ? json_decode($trans_data['checkout_form_data'], true) : array(); 
				if($checkout_form_data){
			?>
			<tr>
				<td align="center" bgcolor="#ffffff">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width:600px">
						<tbody>
							<tr>
								<td align="center" bgcolor="#eec966">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tbody>
											<tr>
												<td width="600px" height="391px" bgcolor="#0081d3" valign="top" align="center" style="background:#fae17c url(http://173.212.197.128/trade-international/public/img/img.jpg) no-repeat bottom right/cover">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tbody>
															<tr>
																<td height="20px">&nbsp;</td>
															</tr>
															<tr>
																<td align="center" valign="top" style="padding:0px 20px 0px 20px">
																	<table width="550px" border="0" cellspacing="0" cellpadding="0" align="center">
																		<tbody>
																			<tr>
																				<td width="12px" style="padding:0px 5px 0px 5px">&nbsp;</td>
																				<td width="275" align="left" style="padding:0px 10px 0px 0">
																					<img src="http://173.212.197.128/trade-international/public/img/logo-logo.png" alt="img">
																				</td>
																				<td width="254" height="30px" valign="middle" style="padding-left:8px;text-align:right;padding-right:10px">
																					<a href="tel:+919783700444" style="white-space:nowrap;background:#fff;color:#222;font-size:14px;line-height:32px;border-radius:6px;display:inline-block;padding:0 16px 0px 16px;vertical-align:middle;margin:0px;padding-bottom:2px;text-decoration: none;">+919783700444</a>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
															<tr>
																<td height="20px">&nbsp;</td>
															</tr>
															<tr>
																<td align="center" valign="top" style="padding:0px 20px 0px 20px" width="530px">
																	<table width="530px" border="0" cellspacing="0" cellpadding="0" align="center">
																		<tbody>
																			
																			<tr>
																				<td style="color:#ffffff;font-size:20px;font-family:Arial,'sans-serif';line-height:25px; padding-left:12px;"><strong>Your booking is cancelled</strong></td>
																			</tr>
																			<tr>
																				<td align="left" valign="top">
																					<table width="400px" border="0" cellspacing="0" cellpadding="0">
																						<tbody>
																							<tr>
																								<td height="5px">&nbsp;</td>
																							</tr>
																							<tr>
																								<td style="padding:0px 15px 0px 15px">
																									<table width="100%" border="0" cellspacing="0" cellpadding="0">
																										<tbody>
																											<tr>
																											 
																												<td align="left" valign="middle" style="color:#ffffff;font-size:14px;font-family:Arial,'sans-serif';line-height:19px">Hello {{$checkout_form_data['customerName'] ?? 'Dear'}}, It's sad we won't be seeing you. We're listing the details for your cancellation below. Hope to see you in the future. </td>
																												<td width="30px" align="left" valign="top">
																													<img src="http://173.212.197.128/trade-international/public/img/assured-img.png" width="45" height="40" alt="" style="display:block" class="CToWUd">
																												</td>
																											</tr>
																										</tbody>
																									</table>
																								</td>
																							</tr>
																							<tr>
																								<td style="color:#ffffff;font-size:14px;font-family:Arial,'sans-serif';line-height:20px;padding:15px 15px 0px 15px">In case you face issues with your check-in, contact us for immediate assistance and you may avail a free stay. To know more click here. <a href="{{url('contact-us')}}" style="text-decoration:underline;color:#ffffff" target="_blank" rel="noopener noreferrer"><strong>click here</strong></a>. <br>
																									<br>
																								Check out our safety &amp; sanitisation measures.</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="25px">&nbsp;</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
															<tr>
																<td height="15px">&nbsp;</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							 
							<tr>
								<td align="center" bgcolor="#eec966">&nbsp;</td>
							</tr>
							<tr>
								<td align="center" height="30px">
									<img src="http://173.212.197.128/trade-international/public/img/white-bg.jpg" width="600" height="20" alt="" style="display:block" class="CToWUd">
								</td>
							</tr>
							<tr>
								<td align="center" style="padding:0px 20px 0px 20px">
									<table width="536px" border="0" cellspacing="0" cellpadding="0" align="center">
										<tbody>
											 
											<tr>
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tbody>
															<tr>
																<td align="left" valign="middle">
																	<table width="330px" border="0" cellspacing="0" cellpadding="0">
																		<tbody>
																			<tr>
																				<td style="font-size:12px;line-height:1.5;color:rgba(0,0,0,0.37);font-family:Arial,'sans-serif'"> Hotel address</td>
																			</tr>
																			<tr>
																				<td style="font-size:15px;color:#000000;margin-top:4px;font-family:Arial,'sans-serif'"><strong>Hotel The Trade International</strong></td>
																			</tr>
																			<tr>
																				<td style="margin-top:2px;color:rgba(0,0,0,0.54);font-family:Arial,'sans-serif';font-size:15px">Jaipur - Ajmer Expy, Near Riico(Bagru), Jaipur, Rajasthan - 303007, India</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
																<td align="left" valign="middle" width="30px">&nbsp;</td>
																<td style="text-align:right" width="120px">
																	<a href="https://www.google.com/maps/place/THE+TRADE+INTERNATIONAL/@26.893741,75.739218,16z/data=!4m8!3m7!1s0x0:0x524a64d4535f2778!5m2!4m1!1i2!8m2!3d26.8937406!4d75.7392178?hl=en-GB" target="_blank" rel="noopener noreferrer" style="color:#e9cc57;font-weight:600;font-size:14px;line-height:24px;font-family:Arial,'sans-serif'">Get directions</a>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td height="15px">&nbsp;</td>
											</tr>
											<tr>
												<td style="margin-top:25px;height:1px;background-color:#dedede"></td>
											</tr>
											<tr>
												<td height="15px">&nbsp;</td>
											</tr>
											<tr>
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tbody>
															<tr>
																<td align="left" valign="middle">
																	<table width="280px" border="0" cellspacing="0" cellpadding="0">
																		<tbody>
																			<tr>
																				<td style="font-size:13px;line-height:16px;color:#000000;font-family:Arial,'sans-serif'">For queries related to hotel amenities, early check-in &amp; special requests</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
																<td align="left" valign="middle" width="30px">&nbsp;</td>
																<td style="text-align:right" width="180px">
																	<a href="tel:+919783700444" style="color:#e9cc57;font-weight:600;font-size:14px;line-height:24px;font-family:Arial,'sans-serif'">Call +919783700444</a>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td height="15px">&nbsp;</td>
											</tr>
											<tr>
												<td style="margin-top:25px;height:1px;background-color:#dedede"></td>
											</tr>
											 
											<tr>
												<td height="40px">&nbsp;</td>
											</tr>
											<tr>
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
														<tbody>
															<tr>
																<td style="color:#000000;font-size:20px;font-family:Arial,'sans-serif';line-height:20px">
																	<strong>Need help with your booking?</strong><br>
																	<span style="font-size:12px;line-height:15px;color:rgba(0,0,0,0.37);font-family:Arial,'sans-serif'">Booking Modifications, payments, policies </span>
																</td>
																<td width="20px" style="padding:0px 10px 0px 10px">&nbsp;</td>
																<td style="text-align:right" height="30px">
																	<a href="tel:+919783700444" style="background:#fae17c;color:#222;font-size:14px;line-height:36px;border-radius:6px;display:inline-block;vertical-align:middle;margin:0px;padding:0px 16px 2px 16px; text-decoration: none;">+919783700444</a>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td height="50px">&nbsp;</td>
											</tr>
											<tr>
												<td>

												</td>
											</tr>
											<tr>
												<td height="30px">&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
													<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
														<tbody>
															 
															<tr>
																<td align="center">
																	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
																		<tbody>
																			<tr>
																				<td style="color:#000000;font-size:14px;font-family:Arial,'sans-serif';line-height:24px">© 2021 </td>
																				<td style="width:170px;text-align:center">
																					<a href="https://m.facebook.com/TheTradeInternational/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="">
																						<img style="height:18px;margin:0 10px" src="http://173.212.197.128/trade-international/public/img/NewFacebook.png" class="CToWUd">
																					</a>
																					<a href="https://twitter.com/TheTradeInt/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="">
																						<img style="height:18px;margin:0 10px" src="http://173.212.197.128/trade-international/public/img/NewTwitter.png" class="CToWUd">
																					</a>
																					<a href="https://linkedin.com/company/thetradeinternational/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="">
																						<img style="height:18px;margin:0 10px" src="http://173.212.197.128/trade-international/public/img/linked-in.png" class="CToWUd">
																					</a>
																					<a href="https://instagram.com/TheTradeInternational/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="">
																						<img style="height:18px;margin:0 10px" src="http://173.212.197.128/trade-international/public/img/NewInstagram.png" class="CToWUd">
																					</a>
																				</td>
																				<td align="right" style="color:#000000;font-size:14px;font-family:Arial,'sans-serif';line-height:24px">© 2022 </td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</body>
</html>