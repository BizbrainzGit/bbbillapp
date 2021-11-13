<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('Layouts/adminLayout_Header.php');

$title="Receipt";
  $string='';

  if(isset($data) && count($data)>0){ 
                foreach ($data as $row){
                                        $company_name=$row->company_name;
                                        $selected_id=$row->selected_id;
                                        $created_on=$row->created_on;
                                        $address=$row->address;
                                        $pincode=$row->pincode;
                                        $person_name=$row->person_name;
                                        $person_designation=$row->person_designation;
                                        $mobile_no=$row->mobile_no;
                                        $email=$row->email;
                                        $payment_mode_id=$row->payment_mode_id;
                                        $payment_mode_name=$row->paymenttype_name;
                                        $cityname=$row->cityname;
                                        $statename=$row->state_name;
                                        $bank_name=$row->bank_name;
                                        $grand_total_amount=$row->grand_total_amount;
                                        $gstgrand_total_amount=$row->gstgrand_total_amount;
                                        $discount_amount=$row->discount_amount;
                                        $order_id=$row->order_id;
                                        $igst_amount=$row->igst_amount;
                                        $cgst_amount=$row->cgst_amount;
                                        $sgst_amount=$row->sgst_amount;
                                        if($igst_amount==0){
                                          $gst=($cgst_amount+$cgst_amount);
                                        }else{
                                          $gst=$igst_amount;
                                        }
                                        
 $string .='<div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                   <div class="row grid-margin">
                    <div class="col-12">
                      <div class="header">
                           
                       </div>
                     </div>
                     <div class="col-12" id="receipt_printdata">
                      <div style="border: 2px solid;padding: 5px;border-radius: 12px;">
                      <div class="row clearfixed">
                          <div class="col-sm-4" >  </div>
                          <div class="col-sm-7 form-group" style="text-align: ;"> <h2 style="padding-top: 10px">Customer Receipt</h2>   </div>
                          <div class="col-sm-1"> </div>
                        <hr>
                      
                        
                          
                         <div class="col-sm-2">
                          <label >Receipt No. :</label>
                        </div>
                        <div class="col-sm-4">
                          <div id="receipt_number">'.$selected_id.'</div>
                          
                        </div>
                        
                        <div class="col-sm-2">
                          <label >Date :</label>
                        </div>
                        <div class="col-sm-4">
                          <div id="receipt_date">'.$created_on.'</div>
                          
                        </div>

                        <div class="col-sm-4">
                          <label >Company Name :</label>
                        </div>
                        <div class="col-sm-8">
                          <div id="receipt_company_name">'.$company_name.'</div>
                          
                        </div>


                        

                        <div class="col-sm-2">
                          <label >Contact Person :</label>
                        </div>
                        <div class="col-sm-4"><span id="receipt_person_name"> '.$person_name.'</span>
                          
                        </div>

                         <div class="col-sm-2">
                          <label >Designation :</label>
                        </div>
                        <div class="col-sm-4"><span id="receipt_mobile_no">'.$person_designation.'</span>
                          
                        </div>

                        <div class="col-sm-2">
                          <label >Contact No. :</label>
                        </div>
                        <div class="col-sm-4"><span id="receipt_mobile_no">'.$mobile_no.'</span>
                          
                        </div>

                                              
                        <div class="col-sm-2">
                          <label >Email ID :</label>
                        </div>
                        <div class="col-sm-4"><span id="receipt_email">'.$email.'</span>
                          
                        </div>

                        <div class="col-sm-2">
                          <label >City :</label>
                        </div>
                        <div class="col-sm-4"><span id="receipt_company_city">'.$cityname.'</span>
                          
                        </div>
                        
                        <div class="col-sm-2">
                          <label >State :</label>
                        </div>
                        <div class="col-sm-4"><span id="receipt_company_city">'.$statename.'</span>
                          
                        </div>




                         <div class="col-sm-4">
                          <label >Address :</label>
                        </div>
                        <div class="col-sm-8"><span id="receipt_company_address"> '.$address.'</span>
                         
                        </div>

                        

                        

                        
                       
                        


                        <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-12" >
                        
                        <div class="col-sm-12" style="text-align: center;">
                          <h3>Terms and Conditions</h3>
                        </div>
                        </div>
                        

                        <div class="col-sm-12">
                          <div style="padding: 10px 0px 0px 15px;text-align: justify;"><p> <ul>
                                <li>After payment clearance only contract will be activation.</li>
                                <li>BizBrainz DOES NOT GUARANTEE and do not intend to guarantee any business to its vendor, it is merely a medium which connects general public with vendors of goods and services listed with BizBrainz.
                              </li>
                              <li>After payment clearance customer should be provide content and photos with in 7 Working days for website </li>
                              <li>Contract’s duration is one year or more, unless determined by the parties under this agreement/contract.
                             </li>
                              
                              </ul></p></div>
                        </div> 
                        </div> 
                        </div>
                      
                      

                         <div class="col-sm-6">
                          <div style="background-color: ;border: 1px solid;border-radius: 12px;"><h4 style="text-align: center;padding: 10px 0px 10px 0px ; background-color: gray;border-radius: 12px 12px 0px 0px;">PAYMENT DETAILS</h4>
                        
                        

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6"> <p>Sub-Total  :</p>   </div>
                           <div class="col-sm-6"><span>'.$grand_total_amount.' </span></div>

                        </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Discount Amount:</p>   </div>
                           <div class="col-sm-6"><span >'.$discount_amount.'</span></div>
                          </div>

                          <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>GST Amount :</p>   </div>
                           <div class="col-sm-6"><span>'. $gst.'</span></div>
                          </div>

                        <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Total Payment Recived :</p>   </div>
                           <div class="col-sm-6"><span>'. $gstgrand_total_amount.'</span></div>
                          </div>

                        

                      <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Payment Methode :</p>  </div>
                           <div class="col-sm-6">  <span> '.$payment_mode_name.' </span></div>
                        </div>';
      if($payment_mode_id==6){

        $string .='<div class="row" style="padding-left:5px;"><div class="col-sm-6">  <p>Cheque No. :</p></div> <div class="col-sm-6"><span>'.$row->cheque_number.'</span></div><div class="col-sm-6">  <p>Bank Name :</p></div> <div class="col-sm-6"><span>'.$row->cheque_bankname.'</span></div><div class="col-sm-6">  <p>IFSC Code :</p></div> <div class="col-sm-6"><span>'.$row->cheque_ifsc.'</span></div> </div>';
        }else if($payment_mode_id==5){
          $string .='<div class="row" style="padding-left:5px;"><div class="col-sm-6">  <p>PayTm No. :</p></div> <div class="col-sm-6"><span>'.$row->paytm_upi.'</span></div> </div>';

        }else if($payment_mode_id==4){
          $string .='<div class="row" style="padding-left:5px;"><div class="col-sm-6">  <p>UPI No. :</p></div> <div class="col-sm-6"><span>'.$row->upi.'</span></div> </div>';

        }else if($payment_mode_id==3){
         $string .='<div class="row" style="padding-left:5px;"><div class="col-sm-6">  <p>Credit Card No. :</p></div> <div class="col-sm-6"><span>'.$row->creditcard_number.'</span></div> </div>';

        }else if($payment_mode_id==2){
          $string .='<div class="row" style="padding-left:5px;"><div class="col-sm-6">  <p>Debit Card No. :</p></div> <div class="col-sm-6"><span>'.$row->debitcard_number.'</span></div></div>';

        }else if($payment_mode_id==1){


        }

              $string .= ' <div class="row" style="padding-left: 5px;">
                           <div class="col-sm-6">  <p>Order Id :</p>   </div>
                           <div class="col-sm-6"><span>'. $order_id.'</span></div>
                          </div>

                          <div class="row">
                           <div class="col-sm-6" >
                                
                                <div class="row" style="padding-left: 5px;">
                                    <div class="col-sm-4">  <p>ME Name :</p>   </div>
                                    <div class="col-sm-8"><span id=""></span></div>
                                </div>
                                <div class="row" style="padding-left: 5px;">
                                     <div class="col-sm-4">  <p>ME Id :</p>   </div>
                                     <div class="col-sm-8"><span id=""></span></div>
                                </div>
                           </div>

                           <div class="col-sm-6" >
                                 <div class="row" style="padding-left: 5px;">
                                   <div class="col-sm-4">  <p>TME Name :</p>   </div>
                                   <div class="col-sm-8"><span id=""></span></div>
                                </div>
                                <div class="row" style="padding-left: 5px;">
                                   <div class="col-sm-4">  <p>TME Id :</p>   </div>
                                    <div class="col-sm-8"><span id=""></span></div>
                                </div>
                                
                           </div>
                            
                      
                       </div>

                      </div>
                    </div>
                        
                      </div>
                    </div>

                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>';

     
}}

                        echo $string;
?>

