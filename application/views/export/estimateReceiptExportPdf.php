<?php
$title=" Proposal ";
$logo="https://devapp.adzbill.in/assets/images/BB_Final_1.JPG";
if($print==1){ $noofrows=12;}else{ $noofrows=20;}
  $string='';
   if(isset($invoicedata) && count($invoicedata)>0){ 
                                            foreach ($invoicedata as $row){
                                        $created_on=$row->created_on; 
                                         }} 


        if(isset($data) && count($data)>0){ 
                foreach ($data as $row){
                                        $company_name=$row->company_name;
                                        $person_name=$row->person_name;
                                        $person_designation=$row->person_designation;
                                        $mobile_no=$row->mobile_no;
                                        $email=$row->email;
                                        $gst_number=$row->gst_number;


                                         $uppersale_amount=$row->uppersale_amount;
                                         if($uppersale_amount==null){
                                            $uppersale=0;
                                        }else{
                                           $uppersale=$uppersale_amount;
                                        }

                                        $discount_amount=$row->discount_amount;
                                        $total_amount=$row->total_amount;
                                        $grand_total_amount=$row->grand_total_amount;
                                        $igst_amount=$row->igst_amount;
                                        $cgst_amount=$row->cgst_amount;
                                        $sgst_amount=$row->sgst_amount;
                                        $gstgrand_total_amount=$row->gstgrand_total_amount;

                                        $paymenttype_name=$row->paymenttype_name;

                                      
                                        $duedate=$row->duedate;
                                        $address=$row->address;
                                        $pincode=$row->pincode;
                                        $cityname=$row->cityname;
                                        $state_name=$row->state_name;

                                         $selected_id=$row->selected_id; 
                                        $receipt_no=$row->receipt_no; 
                                        // if($igst_amount==0 && $igst_amount==null){
                                        //   $gst=$cgst_amount+$sgst_amount;
                                        // }else{
                                        //   $gst=;
                                        // }
                                        $sgst=$row->sgst_amount;
                                        $cgst=$row->cgst_amount;
                                        $igst=$row->igst_amount; 
                                        $tds=$row->tds_amount;
                                        
                                        $payment_mode_id=$row->payment_mode_id;
                                        $payment_mode_name=$row->paymenttype_name;
                                        $order_id=$row->order_id; 
}}
                                        
           

           $string =' <style type="text/css">
        .mainfullwidth{
            width: 100%;
            float: left;
            
         }
         .fullwidth{
            width: 100%;
            float: left;
            margin: 10px 0px 10px 0px;
         }
         .width30{
        width: 30%;
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
      
       .width70{
        width: 70%;
        float: left;
       }
       .width75{
        width: 75%;
        float: left;
       }
         .width80{
            width: 100%;
            margin:left;
         }
       
       .width50{
        width: 50%;
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

       table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
} 

p{   
        margin: 0px;
        padding: 2px;
       }
       div{
        margin: 0px;
        padding: 0px;
       }
 </style>


  <div class="mainfullwidth">
              <div class="width80">
                  <div class="fullwidth">
                 

                     <div class="width25 text-center"><img src="'.$logo.'" style="height:100px;" alt="logo"> 
                      </div>
                      <div class="width75 text-center">
                                    <b class="text-uppercase text-center">BizBrainz Technologies Private Limited</b>
                                    <p>Flat No.16, Paigah Apartments,S.P Road, Secunderabad, Telangana, 500003.</p>
                                    <p> +91 733 77 56789, +91 973 99 89333. Email: hyd@bizbrainz.in, blr@bizbrainz.in</p>
                                   </div>
                    </div>
                    <hr>
                    <div class="fullwidth">
                          <div class="col-lg-12 pl-0 text-center text-uppercase">                              
                              <h1>'.$title.'</h1>
                            </div> 
                       <div class="width50 text-uppercase">
                            <p><b>BizBrainz Technologies Private Limited.</b></p>
                              <p>Flat No.16, Paigah Apartments<br>S.P Road, Secunderabad,<br>Telangana,500003.</p>
                              <p>GST No. : 36AAICB5799E1ZA </p>
                      </div>
                      <div class="width50 text-uppercase text-right"> 
                         
                              <p class="mt-5 mb-2 text-right"><b>'.$company_name.'</b></p>
                              <p class="text-right">'.$address.'</p>
                              <p class="text-right"> GST No. : '.$gst_number.'</p>

                      </div>
                      
                   </div>
                    
                      <div class="fullwidth" >
                            <table class="table">
                                  <thead style="background-color: #1c2c42;color: #ffffff">
                                    <tr>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit cost</th>
                                        <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody> ' ;
                                 
                                if(isset($packageslist) && count($packageslist)>0){ for($j=0; $j<count($packageslist);$j++){  
                                         $package_amount = $packageslist[$j][0]['package_amount']+$uppersale;
                                             $package_name =  $packageslist[$j][0]['package_name'];

                                   $string .=  '<tr class="text-right">
                                     <td class="text-left"> '.$package_name.'</td>
                                     <td>1</td>
                                     <td>'.$package_amount.'</td>
                                     <td>'.$package_amount.'</td>
                                     </tr>';

                                 } }  

                                 if(isset($campaignlist) && count($campaignlist)>0){ for($j=0; $j<count($campaignlist);$j++){  
                                             $campaign_amount = $campaignlist[$j][0]['campaign_amount'];
                                             $campaign_name =  $campaignlist[$j][0]['campaign_name'];

                                   $string .=  '<tr class="text-right">
                                   
                                     <td class="text-left"> '.$campaign_name.'</td>
                                     <td>1</td>
                                     <td>'.$campaign_amount.'</td>
                                     <td>'.$campaign_amount.'</td>
                                     </tr>';

                                 } }

                               $string .=   '</tbody>
                            </table>
                        </div>
                       <div class="fullwidth">
                            <p class="text-right mb-2">Sub - Total Amount:&nbsp; &nbsp;'.$total_amount.'</p>
                            <p class="text-right mb-2">Discount Amount:&nbsp; &nbsp;'.$discount_amount.'</p>
                            <p class="text-right mb-2">Total Amount: &nbsp; &nbsp;'.$grand_total_amount.'</p>
                            <p class="text-right">SGST (9%) :&nbsp; &nbsp;'.$sgst.'</p>
                            <p class="text-right">CGST (9%) :&nbsp; &nbsp;'.$cgst.'</p>
                            <p class="text-right">IGST (18%) :&nbsp; &nbsp;'.$igst.'</p> 
                             <p class="text-right">TDS (2%) :&nbsp; &nbsp;'.$tds.'</p>
                            <h4 class="text-right mb-5">Total : &nbsp; &nbsp;'.$gstgrand_total_amount.'</h4>
                            <hr>
                        </div>
                        <div class="fullwidth text-center">
                                    <b class="text-uppercase">BizBrainz Technologies Private Limited.</b>
                                     <p>Visit Our Website www.bizbrainz.in </p>
                            </div>
                 </div>
              </div> ';

            // }}

  echo $string; 

?>

