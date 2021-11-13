<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
//include('Layouts/adminLayout_Header.php');

// $title="Customer Receipt"; 
$logo="https://devapp.adzbill.in/assets/images/BB_Final_1.JPG";
  $string='';
 //   $string.='<table width="96%" style="margin-top:10px">
	// <tr>
	// <td align="center" colspan="3"><font size="24"><strong>'.$title.'</strong></font></td>
	// </tr>
	// <br />
	// </table><br />';
  $string.='<style type="text/css">
         .mainfullwidth{
            width: 100%;
            float: left;
            border:1px solid ;
            border-radius:20px;
           
         }
         .fullwidth{
            width: 100%;
            float: left;
         }
         .width80{
            width: 100%;
            margin:auto;
         }
       
       .width50{
        width: 50%;
        float: left;
       }
       .width30{
        width: 30%;
        float: left;
       }
       .width70{
        width: 70%;
        float: left;
       }
       .width75{
        width: 75%;
        float: left;
       }
        .width60{
        width: 60%;
        float: left;
       }
        .width40{
        width: 40%;
        float: left;

       }

       .width20{
        width: 20%;
        float: left;

       }
      .width25{
        width: 25%;
        float: left;

       }

       .width45{
          width: 48%;
         float: left;
         
       }
       .text-uppercase{
        
        text-transform: uppercase;
       }
       .text-right{
        text-align: right;
       }
       .text-center{
        text-align: center;
       }
       p{
        margin: 0px;
        padding: 2px;
       }
       div{
        margin: 0px;
        padding: 0px;
       }
       </style>';
    
    if(isset($title) && count($title)>0){  
                 $title=$title;
                  }else{
                  $title="Customer Receipt"; 
                  }
                // foreach ($title as $row){ $title=$row->company_name; }

 
  if(isset($data) && count($data)>0){ 
                foreach ($data as $row){
                                        $company_name=$row->company_name;
                                        $person_name=$row->person_name;
                                        $person_designation=$row->person_designation;
                                        $mobile_no=$row->mobile_no;
                                        $email=$row->email;
                                        $gst_number=$row->gst_number;

                                        $discount_amount=$row->discount_amount;
                                        $total_amount=$row->total_amount;
                                        $grand_total_amount=$row->grand_total_amount;
                                        $igst_amount=$row->igst_amount;
                                        $cgst_amount=$row->cgst_amount;
                                        $sgst_amount=$row->sgst_amount;
                                        $gstgrand_total_amount=$row->gstgrand_total_amount;

                                       

                                        $created_on=$row->created_on;
                                        $address=$row->address;
                                        $pincode=$row->pincode;
                                        $cityname=$row->cityname;
                                        $state_name=$row->state_name;

                                        $selected_id=$row->selected_id; 

                                        if($igst_amount==0){
                                          $gst=($cgst_amount+$cgst_amount);
                                        }else{
                                          $gst=$igst_amount;
                                        }

                                        $payment_mode_id=$row->payment_mode_id;
                                        $payment_mode_name=$row->paymenttype_name;
                                        $paymenttype_name=$row->paymenttype_name;
                                        
                                        $order_id=$row->order_id;

                                        $transaction_status=$row->transaction_status;
                                        $transaction_amount=$row->transaction_amount; 
                                        $id=$row->id;
                                        $business_id=$row->business_id;

                        //                 <div class="fullwidth" style="padding-left: 5px;">
                        //     <div class="width60"> <p> Sub-Total: </p> </div>
                        //     <div class="width30"><p >'.$total_amount.'</p ></div>
                        // </div> 

                        // <div class="fullwidth" style="padding-left: 5px;">
                        //     <div class="width60"> <p>Discount Amount: </p> </div>
                        //     <div class="width30"><p >'.$discount_amount.'</p ></div>
                        // </div>

                        // <div class="fullwidth" style="padding-left: 5px;">
                        //     <div class="width60"> <p> GST : </p> </div>
                        //     <div class="width30"><p >'.$gst.'</p ></div>
                        // </div>
                         
                        // <div class="fullwidth" style="padding-left: 5px;">
                        //     <div class="width60"> <p> <b>Grand Total : </b></p> </div>
                        //     <div class="width30"><p><b>'.$gstgrand_total_amount.'</b></p ></div>
                        // </div>
       
      $string .=' 
<div class="mainfullwidth">
  <div class="width80">
    <div class="fullwidth" style="border-bottom:1px solid;">
          <div class="width30 text-center">
            <img src="'.$logo.'" style="height:80px;" alt="logo">
         </div>

         <div class="width70">
            <h1>'.$title.'</h1>   
         </div>
   </div>
   
       <div class="fullwidth">
          <div class="width50">
            <div class="width50">
               <p>Receipt No. :</p>
                </div>
            <div class="width50">
               <div><p>'.$id.'</p></div>
            </div>
         </div>

         <div class="width50">
          <div class="width50">
                 <p>Date :</p>
                </div>
            <div class="width50">
               <div><p>'.$created_on.'</p></div>
            </div> 
         </div>
   </div>

    <div class="fullwidth">
          <div class="width50">
            <div class="width50">
               <p>Business Name :</p>
                </div>
            <div class="width50">
               <div><p>'.$company_name.'</p></div>
            </div>
         </div>

         <div class="width50">
          <div class="width50">
                 <p>Business Id :</p>
                </div>
            <div class="width50">
               <div><p>'.$business_id.'</p></div>
            </div> 
         </div>
   </div>

    <div class="fullwidth">
          <div class="width50">
            <div class="width50">
               <p>City :</p>
                </div>
            <div class="width50">
                 <p >'.$cityname.'</p >
            </div>
         </div>

         <div class="width50">
          <div class="width50">
                <p>State :</p>
                </div>
            <div class="width50">
                <p >'.$state_name.'</p >
            </div> 
         </div>
   </div>


    <div class="fullwidth">
          <div class="width50">
            <div class="width50">
                <p>Contact Person :</p>
                </div>
            <div class="width50">
                <div><p>'.$person_name.'</p></div>
            </div>
         </div>

         <div class="width50">
          <div class="width50">
                 <p>Contact Number:</p>
                </div>
            <div class="width50">
               <div><p>'.$mobile_no.'</p></div>
            </div> 
         </div>
   </div>

   <div class="fullwidth">
          <div class="width50">
            <div class="width50">
                <p>Designation :</p>
                </div>
            <div class="width50">
                <div><p>'.$person_designation.'</p></div>
            </div>
         </div>

         <div class="width50">
          <div class="width25">
                 <p>Email ID :</p>
                </div>
            <div class="width75">
               <div><p>'.$email.'</p></div>
            </div> 
         </div>
   </div>

   <div class="fullwidth">
          <div class="width25">
            <p>Address :</p>
         </div>
         <div class="width75">
             <div><p>'.$address.'</p></div>
         </div>
   </div>

   

          <div class="fullwidth" style="padding:10px;">
                   <div class="width45" style="margin:  0px 3px 0px 3px; border: 1px solid gray; border-radius: 12px;">
                     <div style="height:400px;">
                          <div class="fullwidth"  style="text-align: center; background-color: gray;border-radius: 12px 12px 0px 0px;">
                            <h4>Terms and Conditions</h4>
                         </div>

                        <div class="fullwidth">
                              <ul>
                                <li>After payment clearance only contract will be activation.</li>
                                <li>BizBrainz DOES NOT GUARANTEE and do not intend to guarantee any business to its vendor, it is merely a medium which connects general public with vendors of goods and services listed with BizBrainz.
                              </li>
                              <li>After payment clearance customer should be provide content and photos with in 7 Working days for website </li>
                              <li>Contract’s duration is one year or more, unless determined by the parties under this agreement/contract.
                             </li>
                              
                              </ul> 
                        </div>
                       </div>
                       
                         
                  </div>

              <div class="width45" style="margin: 0px 3px 0px 3px; border: 1px solid gray; border-radius: 12px; ">
                     <div style="height:400px;">
                         <div class="fullwidth"  style="text-align: center;  background-color: gray; border-radius: 12px 12px 0px 0px;">
                            <h4>PAYMENT DETAILS</h4>
                         </div>

                        

                         <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width30">  <p>Order ID:</p>  </div>
                           <div class="width60">  <p > '.$order_id.' </p > </div>
                         </div>

                         <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width50">  <p>Payment Method:</p>  </div>
                           <div class="width50">  <p > '.$payment_mode_name.' </p > </div>
                         </div>

                         <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width50">  <p>Transaction Amount:</p>  </div>
                           <div class="width50">  <p > '.$transaction_amount.' </p > </div>
                         </div>

                          <div class="fullwidth" style="padding-left: 5px;">
                           <div class="width50">  <p>Transaction Status:</p>  </div>
                           <div class="width50">  <p > '.$transaction_status.' </p > </div>
                         </div>

                        
                         <div class="fullwidth" style="padding-left: 5px;">
                             <div class="width50">  <p>ME Name :</p>   </div>
                             <div class="width50"><p></p ></div>
                          </div>
                          
                          <div class="fullwidth" style="padding-left: 5px;">
                              <div class="width50">  <p>ME EMP Id :</p>   </div>
                              <div class="width50"><p></p ></div>
                           </div>
                           <div class="fullwidth" style="padding-left: 5px;">
                                <div class="width50"><p>TME Name :</p>   </div>
                                <div class="width50"><p></p ></div>
                            </div>
                            <div class="fullwidth" style="padding-left: 5px;">
                                 <div class="width50">  <p>TME EMP Id :</p>   </div>
                                 <div class="width50"><p></p></div>
                            </div>
                          </div>
                          
                         
                            
                        
                      </div>
                 </div>
            <hr>
                           <div class="fullwidth text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited</b>
                                    <p>CIN: U72900TG2019PTC134639, GST: 36AAICB5799E1ZA </p>
                                    <p>Flat No.16, Paigah Apartments,S.P Road, Secunderabad,Telangana,500003.</p>
                                    <p> +91 733 77 56789 , +91 973 99 89333  Email:
                                       hyd@bizbrainz.in , blr@bizbrainz.in</p>
                                    <p>visit our Website www.bizbrainz.in </p>
                            </div>

  </div>
</div>';


}}

echo $string;



                        
?>

