<!DOCTYPE html>
<html>
<head>
	<title>Room Booked Mail</title>
</head>
<body>
<table width="600px" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width:600px;">
    <tbody>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #060611;">
                    <tbody>
                        <tr style="background:#060611;">
                            <td align="center" valign="top"></td>
                            <td align="left" valign="top" style=" text-align: center;">
                                <a href="https://www.thetradeinternational.com/" style="display:inline-block" target="_blank" rel="noopener noreferrer" data-saferedirecturl="https://www.google.com/url?q=https://www.thetradeinternational.com/&amp;source=gmail&amp;ust=1652849288529000&amp;usg=AOvVaw3u-DKAAw08bNiWJHO8E--c"><img src="https://ci5.googleusercontent.com/proxy/RppfF51tMpXMh0Dh_P9dndG6GDyjDTOpQJ4TGjD6JGClodRYTEB8Un4qdq10s_EoljgIODg5TWAjZ19SVaN29UvCO-lqkKi337h_VoNaOntsjw=s0-d-e1-ft#https://www.thetradeinternational.com/public/email-img/logo.png" alt="Logo" class="CToWUd"></a>
                            </td>
                            <td align="center" valign="top"></td>
                        </tr>
                        <?php
                            $checkout_form_data = !empty($txn_rec) ? json_decode($txn_rec['checkout_form_data'], true) : array(); 
                            if($checkout_form_data){
                        ?>
                        <tr style="background:#efc763;">
                            <td align="center" valign="top" style=""></td>
                            <td align="left" valign="top" style="">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="">
                                    <tbody>
                                        <tr>
                                            <td style="height:15px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#000;font-family:Arial,'sans-serif';line-height:20px; text-align: center;">You have received new Booking from  <strong>{{$checkout_form_data['customerName'] ?? ''}}</strong>.</td>
                                        </tr>
                                        <tr>
                                            <td style="height:4px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="color:#000;font-size:18px;font-family:Arial,'sans-serif';line-height:20px; text-align: center;"><strong>Room summary</strong></td>
                                        </tr>

                                        <tr>
                                            <td style="height:15px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </td>
                            <td align="center" valign="top" style=""></td>
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
                                                                            <td>
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="left" width="180px">Email Id</td>
                                                                                                            <td valign="middle" align="right"><a href="mailto:leena.sharma@purgesoftwares.com" target="_blank" rel="noopener noreferrer" style="color:#f00;">{{$checkout_form_data['customerEmail'] ?? ''}}</a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Phone Number</td>
                                                                                                            <td valign="middle" align="right">{{$checkout_form_data['customerPhone']}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Checkin</td>
                                                                                                            <td valign="middle" align="right">{{date('F d, Y',strtotime($checkout_form_data['checkin']))}} 12:00 PM</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Checkout</td>
                                                                                                            <td valign="middle" align="right">{{date('F d, Y',strtotime($checkout_form_data['checkout']))}} 11:00 AM </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Room</td>
                                                                                                            <td valign="middle" align="right">{{$checkout_form_data['item']['room'] ?? ''}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Guest</td>
                                                                                                            <td valign="middle" align="right">{{$checkout_form_data['item']['guest'] ?? ''}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:20px;"></td>
                                                                                        </tr>

                                                                                    </tbody>
                                                                                </table>


                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="color:#000000;font-size:18px;font-family:Arial,'sans-serif';line-height:20px"><strong>Payment summary</strong></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="220px" align="left">{{ucwords(str_replace('_', ' ', $checkout_form_data['item']['room_category'])) }} Room Charges</td>
                                                                                                            <td valign="middle" align="right">₹{{$checkout_form_data['subtotal_amt'] ?? ''}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Room Tax <small>({{ env('DEFAULT_ROOM_TAX_RATE') }}% Tax)</small></td>
                                                                                                            <td valign="middle" align="right">₹{{$checkout_form_data['subtotal_taxes']}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Meal Total Amount</td>
                                                                                                            <td valign="middle" align="right">₹{{$checkout_form_data['subtotal_meal_amt'] ?? ''}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Meal Tax <small>({{ env('DEFAULT_MEAL_TAX_RATE') }}% Tax)</small></td>
                                                                                                            <td valign="middle" align="right">₹{{$checkout_form_data['subtotal_meal_tax'] ?? ''}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;background: #f0f0f0;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background: #f0f0f0; color: #000000; padding: 0 12px; font-family: Arial,'sans-serif'; font-size: 15px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left"><strong>Total Amount</strong></td>
                                                                                                            <td valign="middle" align="right"><strong>₹{{$checkout_form_data['net_total_amt'] ?? ''}}</strong></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;background: #f0f0f0;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        @if(array_key_exists('extra_charges',$checkout_form_data))		
                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top:2px;color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Additional Charges <small style="font-size: 11px;color: red;line-height: 13px;display: block;font-weight: 500;">(<?php if(array_key_exists('extra_charges',$checkout_form_data))echo $checkout_form_data['extra_charges'];?>)</small></td>
                                                                                                            <td valign="middle" align="left" width="200px"></td>
                                                                                                            <td valign="middle" align="right" width="130px"><i class="fa fa-rupee"></i><?php if(array_key_exists('minus_peoples_amount',$checkout_form_data)) { echo $checkout_form_data['minus_peoples_amount']; }else{ echo $checkout_form_data['add_peoples_amount']; } ?></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endif


                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Reward Points</td>
                                                                                                            <td valign="middle" align="right">- {{$checkout_form_data['subtotal_tti_rewardpoint'] ?? ''}} P</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>


                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">The Trade International Credit</td>
                                                                                                            <td valign="middle" align="right">- {{$checkout_form_data['subtotal_tti_credit'] ?? ''}} P</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>


                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Promocode</td>
                                                                                                            <td valign="middle" align="right">- ₹{{$checkout_form_data['promocode_deduction'] ?? ''}} P</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        


                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="border-top:#9b9b9b"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>


                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="color:#000000;font-family:Arial,'sans-serif';font-size:15px">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left">Payable Amount</td>
                                                                                                            <td valign="middle" align="right">₹{{$checkout_form_data['grand_total_amt'] ?? ''}}</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        

                                                                                        <tr>
                                                                                            <td style="height:10px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="height:10px;background: #efc763;"></td>
                                                                                        </tr>


                                                                                        <tr>
                                                                                            <td>
                                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="background: #efc763; color: #000000; padding: 0 12px; font-family: Arial,'sans-serif'; font-size: 15px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" width="180px" align="left"><strong>Advanced Payment</strong></td>
                                                                                                            <td valign="middle" align="right"><strong>₹{{$checkout_form_data['f_total_amt'] ?? ''}}</strong></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:10px;background: #efc763;"></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td style="height:20px;"></td>
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
                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                            <td width="20px"></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td height="20" style="background:#060611;"></td>
        </tr>

        <tr>
            <td style="background:#060611;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td width="5%"></td>
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
                                            <td width="5%"></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="10"></td>
                        </tr>
                        <tr>
                            <td align="center">
                                <p style="font-family: Arial,'sans-serif'; font-size:13px;line-height:18px;margin:0;color:#9b9b9b">Jaipur - Ajmer Expy, Near Riico(Bagru), Jaipur, Rajasthan - 303007, India</p>
                            </td>
                        </tr>
                        <tr>
                            <td height="20"></td>
                        </tr>
                    </tbody>
                </table>	
            </td>
        </tr>

    </tbody>
</table>
</body>
</html>