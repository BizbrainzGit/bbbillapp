<?php
$title="Business Dealclosed List";
if($print==1){ $noofrows=15;}else{ $noofrows=20;}
  $string='';

  $string.='<table width="96%" style="margin-top:10px">
        <tr>
        <td align="center" colspan="3"><font size="18"><strong>'.$title.'</strong></font></td>
        </tr>
        <br/>
        </table><br />';
 $string.=' <table width="95%" border="1" cellpadding="1" cellspacing="0" style="text-align:center;vertical-align: middle;border-collapse:collapse" >
    <tr valign="middle">
                <th width="5%" ><strong>S.No.</strong></th>
                <th width="10%"><strong>Company Name</strong> </th>
                <th width="10%"><strong>Business Id</strong></th>
                <th width="10%"><strong>Person Name</strong></th>
                <th width="10%"><strong>Mobile No</strong></th>
                <th width="10%"><strong>City Name</strong> </th>
                <th width="10%"><strong>Package Name</strong></th>
                <th width="20%"><strong>Compain Name</strong></th>
                <th width="10%"><strong>Package Grand Total Amount</strong></th>
                <th width="10%"><strong>Package Date</strong></th>
                <th width="10%"><strong>Transaction Amount</strong></th>
                <th width="10%"><strong>Deal Closed Date</strong> </th>
                <th width="15%"><strong>Package Given By</strong></th>
                <th width="15%"><strong>Business Created By</strong></th>
              
        </tr>';

        $i=0;
                        if(isset($data) && count($data)>0){
                                foreach ($data as $row){
                                        
                                        $id=$row->id;
                                        $company_name=$row->company_name;
                                        $business_id=$row->business_id;
                                        $person_name=$row->person_name;
                                        $mobile_no=$row->mobile_no;
                                        $cityname=$row->cityname;
                                        $package_name=$row->package_name;
                                        $campaign_name=$row->campaign_name;
                                        $gstgrand_total_amount=$row->gstgrand_total_amount;
                                        $payment_created_on=$row->payment_created_on;
                                        $transaction_amount=$row->transaction_amount;
                                        $dealclosed_created_on=$row->dealclosed_created_on;
                                        $package_created_name=$row->package_created_name;
                                        $business_created_name=$row->business_created_name;
                                        
                                        
                                       
                                        if(($i%$noofrows)==0 && $i!=0)
                                        {
                                                $string.='</table><div style="page-break-before: always"></div>
                                                <table width="96%" style="margin-top:10px">
                                           <tr>
                                            <td align="center" colspan="3"><font size="18"><strong>'.$title.'</strong></font></td>
                                           </tr>
                                           </table><br />
                        <table width="95%" border="1" cellpadding="1" cellspacing="0" style="text-align:center;vertical-align: middle;border-collapse:collapse">
                                                <tr valign="middle">
                                                        <th><strong>S.No.</strong></th>
                                                        <th><strong>Company Name</strong> </th>
                                                        <th><strong>Business Id</strong></th>
                                                        <th><strong>Person Name</strong></th>
                                                        <th><strong>Mobile No</strong></th>
                                                        <th><strong>City Name</strong> </th>
                                                        <th><strong>Package Name</strong></th>
                                                        <th><strong>Compain Name</strong></th>
                                                        <th><strong>Package Grand Total Amount</strong></th>
                                                        <th><strong>Package Date</strong></th>
                                                        <th><strong>Transaction Amount</strong></th>
                                                        <th><strong>Deal Closed Date</strong> </th>
                                                        <th><strong>Package Given By</strong></th>
                                                        <th><strong>Business Created By</strong></th>
                                                       
                                                        
                                                </tr>';
                                        }
                                         $string.='<tr valign="middle">
                                                <td width="5%">'.$id.'</td>
                                                <td width="10%">'.$company_name.'</td>
                                                <td width="10%">'.$business_id.'</td>
                                                <td width="10%">'.$person_name.'</td>
                                                <td width="10%">'.$mobile_no.'</td>
                                                <td width="10%">'.$cityname.'</td>
                                                <td width="10%">'.$package_name.'</td>
                                                <td width="20%">'.$campaign_name.'</td>
                                                <td width="15%">'.$gstgrand_total_amount.'</td>
                                                <td width="10%">'.$payment_created_on.'</td>
                                                <td width="10%">'.$transaction_amount.'</td>
                                                <td width="10%">'.$dealclosed_created_on.'</td>
                                                <td width="15%">'.$package_created_name.'</td>
                                                <td width="15%">'.$business_created_name.'</td>


                                                </tr>';
                                                $i++;
 }
                        }
                        $string.='</table><br />';
                        echo $string;
?>

