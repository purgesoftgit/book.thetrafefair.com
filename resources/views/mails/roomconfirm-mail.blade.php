<!DOCTYPE html>
<html>
<head>
	<title>Room Booked Mail</title>
</head>
<body>
  <div style="background:#ffffff;margin:0;padding:0px;" bgcolor="#FFFFFF">
  <table style="max-width:600px;border:0px solid #b6b6b7" width="600px" cellspacing="0" cellpadding="0" border="0"align="center">
    <tbody>

    <?php 
        $phone_number = $address = $email_address = '';
        foreach ($setting as $sett_key => $sett_data){
          if($sett_data->key == "phone_number") 
            $phone_number = explode(",",$sett_data->value)[0];
           
          if($sett_data->key == "address") 
            $address = $sett_data->value;
        }

        $checkout_form_data = !empty($txn_rec) ? json_decode($txn_rec['checkout_form_data'], true) : array(); 
				if($checkout_form_data){
    ?>

      <tr>
        <td bgcolor="#03030e" align="center">
          <table style="max-width:600px color:#fff;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
              <tr>
                <td>
                  <table style="background:url({{asset('img/email-bg.jpg')}}) no-repeat 0 0; padding-left:12px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                    <tr>
                      <td align="center">
                        <table width="100%" cellspacing="0"
                        cellpadding="0" border="0" align="center">
                        <tbody>
                          <tr>
                            <td width="600px" valign="top" height="391px" align="center">
                              <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                  <tr>
                                    <td height="20px"></td>
                                  </tr>
                                  <tr>
                                    <td style="padding:0px 20px 0px 20px" valign="top" align="center">
                                      <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                        <tbody>
                                          <tr>
                                            <td style="padding:0px 10px 0px 0" width="287" align="left">
                                              <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer"><img src="{{asset('img/logo.png')}}" alt="img" moz-do-not-send="true"></a>
                                            </td>
                                            <td style="padding-left:8px;text-align:right;" width="254" valign="middle" height="30px">
                                              <a href="tel:{{ $phone_number }}" style="white-space:nowrap;background:#f4d26e;color:#000;font-size:14px;line-height:32px;border-radius:6px;display:inline-block;padding:0 16px 0px 16px; vertical-align:middle; margin:0px; padding-bottom:2px; text-decoration:none;" moz-do-not-send="true">{{ $phone_number }}</a>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="20px"></td>
                                  </tr>
                                  <tr>
                                    <td style="padding:0px 20px 0px 20px" width="530px" valign="top" align="center">
                                      <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                        <tbody>
                                          <tr>
                                            <td style="color:#fff;font-size:20px;font-family:Arial,'sans-serif';line-height:25px;">
                                              <strong>Your booking is confirmed</strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td valign="top" align="left">
                                              <table width="330px" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                  <tr>
                                                    <td height="5px"></td>
                                                  </tr>
                                                  <tr>
                                                    <td style="padding:0px 15px 0px 0">
                                                      <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                        <tbody>
                                                          <tr>
                                                            <td style="color:#9b9b9b;font-size:14px;font-family:Arial,'sans-serif';line-height:19px" valign="middle" align="left">Hello {{$checkout_form_data['customerName'] ?? 'Dear'}}, Thank you for choosing Hotel The Trade Fair. We’re all set to serve you hassle-free stays with Check-in Assured. </td>
                                                            <td width="30px" valign="top" align="left">
                                                              <img src="https://thetradeinternational.com/public/img/assured-img.png" alt="" style="display:block" class="CToWUd" moz-do-not-send="true" width="45" height="40">
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td style="color:#9b9b9b;font-size:14px;font-family:Arial,'sans-serif';line-height:20px;padding:15px 15px 0px 0">In case you face issues with your check-in, contact us for immediate assistance and you may avail a free stay. To know more <a href="{{ env('TTF_URL').'about-us' }}" style="text-decoration:underline;color:#f4d26e" target="_blank" rel="noopener noreferrer" moz-do-not-send="true"><strong>click here</strong></a>.
                                                      <br>
                                                      <br>Check out our safety &amp; sanitisation measures.</td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td height="25px"></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="15px"></td>
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
                      <td style="padding:0px 20px 0px 20px" valign="top" align="center">
                        <table style="min-height:90px; width:100%;">
                          <tbody>
                            <tr>
                              <td style="padding-right:24px;padding:3px 9px 3px 0">
                                <div style="font-size:12px;line-height:1.5;color:#000;font-family:Arial,'sans-serif'">Check in</div>
                                <div style="margin-top:4px;font-size:16px;font-weight:bold;line-height:1.25;color:#000;font-family:Arial,'sans-serif'">{{date('D, M d, Y',strtotime($checkout_form_data['checkin']))}}</div>
                                <div style="margin-top:4px;font-size:12px;line-height:1.5;color:#000;font-family:Arial,'sans-serif'">From 12:00 PM </div>
                              </td>
                              <td>
                                <div style="width:13px;height:16px;border-right:1px solid #000"> </div>
                                <div style="width:24px;border-radius:2px;border:solid 1px #000;font-size:11px;font-weight:bold;text-align:center;color:#000;line-height:18px">1N</div>
                                <div style="width:13px;height:16px;border-right:1px solid #000"></div>
                              </td>
                              <td style="padding-right:24px;padding:3px 9px">
                                <div style="font-size:12px;line-height:1.5;color:#000;font-family:Arial,'sans-serif'">Check out</div>
                                <div style="margin-top:4px;font-size:16px;font-weight:bold;line-height:1.25;color:#000;font-family:Arial,'sans-serif'">{{date('D, M d, Y',strtotime($checkout_form_data['checkout']))}}</div>
                                <div
                                style="margin-top:4px;font-size:12px;line-height:1.5;color:#000;font-family:Arial,'sans-serif'">Till 11:00 AM </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" height="20"></td>
                    </tr>

                  </table>
                </td>
              </tr>

              <tr>
                <td height="30px" align="center"></td>
              </tr>
              <tr>
                <td style="padding:0px 20px 0px 20px" align="center">
                  <table width="536px" cellspacing="0" cellpadding="0" border="0" align="center">
                    <tbody>
                      <tr>
                        <td style="color:#fff;font-size:20px;font-family:Arial,'sans-serif';line-height:25px">
                            <strong>Booking details</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:#fff;font-size:15px;font-family:Arial,'sans-serif';line-height:25px">
                            <small>Txn ID : {{$txn_rec['txnid']}}</small><br>
                            <small>PIN Number : {{$txn_rec['pin_code']}}</small>
                        </td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                              <tr>
                                <td valign="middle" align="left">
                                  <table width="330px" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                        <td style="font-size:12px;line-height:1.5;color:#9b9b9b;font-family:Arial,'sans-serif'">Hotel address</td>
                                      </tr>
                                      <tr>
                                        <td style="font-size:15px;color:#fff;margin-top:4px;font-family:Arial,'sans-serif'"><strong>Hotel The Trade Fair</strong></td>
                                      </tr>
                                      <tr>
                                        <td style="margin-top:2px;color:#9b9b9b;font-family:Arial,'sans-serif';font-size:15px">{{ $address }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td width="30px" valign="middle" align="left"></td>
                                <td style="text-align:right" width="120px">
                                  <a href="https://maps.app.goo.gl/BD8RsfoKKnwet262A" target="_blank" rel="noopener noreferrer" style="color:#e9cc57;font-weight:600;font-size:14px;line-height:24px;font-family:Arial,'sans-serif'" moz-do-not-send="true">Get directions</a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                      <tr>
                        <td style="border-top:1px solid #9b9b9b;"></td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                              <tr>
                                <td valign="middle" align="left">
                                  <table width="280px" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                        <td style="font-size:13px;line-height:16px;color:#fff;font-family:Arial,'sans-serif'">For queries related to hotel amenities, early check-in &amp; special requests</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td width="30px" valign="middle" align="left"></td>
                                <td style="text-align:right" width="200px">
                                  <a href="tel:{{ $phone_number }}" style="color:#e9cc57;font-weight:600;font-size:14px;line-height:24px;font-family:Arial,'sans-serif'" moz-do-not-send="true">Call {{ $phone_number }}</a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                      <tr>
                        <td style="border-top:1px solid #9b9b9b;"></td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                              <tr>
                                <td valign="middle" align="left">
                                  <table width="330px" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                        <td style="font-size:12px;line-height:1.5;color:#9b9b9b;font-family:Arial,'sans-serif'">No. of guests</td>
                                      </tr>
                                      <tr>
                                        <td style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px">{{$checkout_form_data['item']['guest']}}  Adult, {{$checkout_form_data['item']['children'] ?? '0'}} Children</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td width="30px" valign="middle" align="left"></td>
                                <td style="text-align:right" width="120px"> <br></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                      <tr>
                        <td style="border-top:1px solid #9b9b9b;"></td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                              <tr>
                                <td valign="middle" align="left">
                                  <table width="330px" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                        <td style="font-size:12px;line-height:1.5;color:#9b9b9b;font-family:Arial,'sans-serif'">No. of rooms</td>
                                      </tr>
                                      <tr>
                                        <td style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px">{{$checkout_form_data['item']['room']}} {{ ucwords(str_replace('_', ' ', $checkout_form_data['item']['room_category'])) ?? ''}} Room</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td width="30px" valign="middle" align="left"></td>
                                <td style="text-align:right" width="120px"> <br></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="15px"></td>
                      </tr>
                     
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>
                              <tr>
                                <td style="color:#fff;font-size:20px;font-family:Arial,'sans-serif';line-height:20px">
                                  <strong>Need help with your booking?</strong><br>
                                  <span style="font-size:12px;line-height:15px;color:#9b9b9b;font-family:Arial,'sans-serif'">Booking Modifications, payments, policies </span>
                                </td>
                                <td style="padding:0px 10px 0px 10px" width="20px"></td>
                                <td style="text-align:right" height="30px"> <a href="tel:{{ $phone_number }}" style="background:#fae17c;color:#222;font-size:14px;line-height:36px;border-radius:6px;display:inline-block;vertical-align:middle;margin:0px;padding:0px 16px 2px 16px; text-decoration: none;" moz-do-not-send="true">{{ $phone_number }}</a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="50px"></td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>
                              <tr>
                                <td style="color:#fff;font-size:20px;font-family:Arial,'sans-serif';line-height:20px"><strong>Payment summary</strong></td>
                              </tr>
                              <tr>
                                <td style="height: 8px;"></td>
                              </tr>
                              <tr>
                                <td>
                                  <table style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td width="200px" valign="middle" align="left">{{ucwords(str_replace('_', ' ', $checkout_form_data['item']['room_category'])) }} Room Charges</td>
                                        <td width="200px" valign="middle" align="left"><br>
                                        </td>
                                        <td width="130px" valign="middle" align="right">₹{{$checkout_form_data['subtotal_amt'] ?? ''}}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="height: 8px;"></td>
                              </tr>
                              <tr>
                                <td style="border-top:1px solid #9b9b9b; height:8px;"></td>
                              </tr>
                              <tr>
                                <td></td>
                              </tr>
                              <tr>
                                <td>
                                  <table style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td width="200px" valign="middle" align="left">Room Tax <small>({{ env('DEFAULT_ROOM_TAX_RATE') }}% Tax)</small></td>
                                        <td width="200px" valign="middle" align="left"><br></td>
                                        <td width="130px" valign="middle" align="right">₹{{$checkout_form_data['subtotal_taxes']}}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="height: 8px;"></td>
                              </tr>
                              <tr>
                                <td style="border-top:1px solid #9b9b9b;height: 8px;">
                                </td>
                              </tr>
                             
                              <tr>
                                <td></td>
                              </tr>
                              
                              <tr>
                                <td></td>
                              </tr>
                              <tr>
                                <td>
                                  <table style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td width="200px" valign="middle" align="left"><strong>Total Amount</strong></td>
                                        <td width="200px" valign="middle" align="left"><br></td>
                                        <td width="130px" valign="middle" align="right"><strong>₹{{$checkout_form_data['net_total_amt'] ?? ''}}</strong></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="height: 8px;"></td>
                              </tr>
                              <tr>
                                <td style="border-top:1px solid #9b9b9b;height: 8px;"></td>
                              </tr> 
                              	@if(array_key_exists('extra_charges',$checkout_form_data))		
                                <tr>
                                  <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:2px;color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                      <tbody>
                                        <tr>
                                          <td valign="middle" width="180px" align="left" style="color:#fff;">Additional Charges <small style="font-size: 11px;color: red;line-height: 13px;display: block;font-weight: 500;">(<?php if(array_key_exists('extra_charges',$checkout_form_data))echo $checkout_form_data['extra_charges'];?>)</small></td>
                                          <td valign="middle" align="left" width="200px"></td>
                                          <td valign="middle" align="right" width="130px" style="color:#fff;"><i class="fa fa-rupee"></i><?php if(array_key_exists('minus_peoples_amount',$checkout_form_data)) { echo $checkout_form_data['minus_peoples_amount']; }else{ echo $checkout_form_data['add_peoples_amount']; } ?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              @endif
                              <tr>
                                <td style="height: 8px; "></td>
                              </tr>
                              <tr>
                                <td style="border-top:1px solid #9b9b9b;height: 8px; "></td>
                              </tr>
                             
                              <tr>
                                <td></td>
                              </tr>
                               
                              
                              <tr>
                                <td></td>
                              </tr>
                              <tr>
                                <td>
                                  <table style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td width="200px" valign="middle" align="left">Promocode</td>
                                        <td width="200px" valign="middle" align="left"><br></td>
                                        <td width="130px" valign="middle" align="right">- {{$checkout_form_data['promocode_deduction'] ?? ''}} P</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="height: 8px;"></td>
                              </tr>
                              <tr>
                                <td style="border-top:1px solid #9b9b9b;height: 8px;"></td>
                              </tr>
                              <tr>
                                <td></td>
                              </tr>
                              <tr>
                                <td>
                                  <table style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td width="200px" valign="middle" align="left">Payable Amount</td>
                                        <td width="200px" valign="middle" align="left"><br></td>
                                        <td width="130px" valign="middle" align="right">₹{{$checkout_form_data['grand_total_amt'] ?? ''}}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td style="height: 8px;"></td>
                              </tr>
                              <tr>
                                <td style="border-top:1px solid #9b9b9b;height: 8px;"></td>
                              </tr>
                              <tr>
                                <td></td>
                              </tr>
                              <tr>
                                <td>
                                  <table style="margin-top:2px;color:#fff;font-family:Arial,'sans-serif';font-size:15px" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td width="200px" valign="middle" align="left"><strong>Advanced Payment</strong></td>
                                        <td width="200px" valign="middle" align="left"><br></td>
                                        <td width="130px" valign="middle" align="right"><strong>₹{{$checkout_form_data['f_total_amt'] ?? ''}}</strong></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="40px"></td>
                      </tr>
                      <tr>
                        <td height="30px"></td>
                      </tr>
                      <tr>
                        <td>
                          <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>
                              <tr>
                                <td
                                style="color:#fff;font-size:20px;font-family:Arial,'sans-serif';line-height:24px"><strong>Hotel Rules</strong></td>
                              </tr>
                              <tr>
                                <td height="15px"></td>
                              </tr>
                              <tr>
                                <td>
                                  <ul style="margin:0px;padding:0px;color:#fff;font-family:Arial,'sans-serif';font-size:15px;line-height:24px">
                                    <li>Couples are welcome</li>
                                    <li>Guests can check in using any local or outstation ID proof.</li>
                                    <!-- <li>For more details, please read our <a href="#" target="_blank" data-saferedirecturl="">guest policies.</a></li> -->
                                  </ul>
                                </td>
                              </tr>
                              <tr>
                                <td height="35px"></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td> <br>
                        </td>
                      </tr>
                      <tr>
                        <td height="30px"></td>
                      </tr>
                      <tr>
                        <td align="center">
                          <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody>
                              <tr>
                                <td style="color:#fff;font-size:14px;font-family:Arial,'sans-serif';line-height:24px" align="center">Thank you and we hope you enjoy your stay</td>
                              </tr>
                              <tr>
                                <td height="40px"></td>
                              </tr>
                              <tr>
                                <td align="center">
                                  <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                    <tbody>
                                      <tr>
                                        <td style="color:#fff;font-size:14px;font-family:Arial,'sans-serif';line-height:24px">&copy;2021</td>
                                        <td style="width:170px;text-align:center">
                                          <a href="https://m.facebook.com/TheTradeInternational/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="" moz-do-not-send="true"><img style="height:18px;margin:0 10px" src="{{asset('img/NewFacebook-confirm.png')}}" class="CToWUd" moz-do-not-send="true">
                                          </a>
                                          <a href="https://twitter.com/TheTradeInt/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="" moz-do-not-send="true"><img
                                            style="height:18px;margin:0 10px" src="{{asset('img/NewTwitter-confirm.png')}}" class="CToWUd" moz-do-not-send="true">
                                          </a>
                                          <a href="https://linkedin.com/company/thetradeinternational/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="" moz-do-not-send="true"> <img style="height:18px;margin:0 10px" src="{{asset('img/linked-confirm.png')}}" class="CToWUd" moz-do-not-send="true">
                                          </a>
                                          <a href="https://instagram.com/TheTradeInternational/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="" moz-do-not-send="true"> <img style="height:18px;margin:0 10px" src="{{asset('img/NewInstagram-confirm.png')}}" class="CToWUd" moz-do-not-send="true">
                                          </a>
                                        </td>
                                        <td style="color:#fff;font-size:14px;font-family:Arial,'sans-serif';line-height:24px" align="right">&copy;{{date('Y')}}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td height="20px"></td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
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
