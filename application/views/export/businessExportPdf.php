<?php
$title="Business List";
if($print==1){ $noofrows=12;}else{ $noofrows=20;}
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
                <th width="15%"><strong>Mobile No</strong></th>
                <th width="10%"><strong>City Name</strong> </th>
                <th width="10%"><strong>State Name</strong></th>
                <th width="20%"><strong>Created By</strong></th>
                <th width="15%"><strong>Created Date</strong></th>
                <th width="10%"><strong>Status</strong></th>
                
              
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
                                        $state_name=$row->state_name;
                                        $created_name=$row->created_name;
                                        $business_created_on=$row->business_created_on;
                                        $status_value=$row->status_value;
                                        
                                       
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
                                                        <th><strong>State Name</strong></th>
                                                        <th><strong>Created By</strong></th>
                                                        <th><strong>Created Date</strong></th>
                                                        <th><strong>Status</strong></th>
                                                       
                                                        
                                                </tr>';
                                        }
                                         $string.='<tr valign="middle">
                                                <td width="5%">'.$id.'</td>
                                                <td width="10%">'.$company_name.'</td>
                                                <td width="10%">'.$business_id.'</td>
                                                <td width="10%">'.$person_name.'</td>
                                                <td width="15%">'.$mobile_no.'</td>
                                                <td width="10%">'.$cityname.'</td>
                                                <td width="10%">'.$state_name.'</td>
                                                <td width="20%">'.$created_name.'</td>
                                                <td width="15%">'.$business_created_on.'</td>
                                                <td width="10%">'.$status_value.'</td>

                                                </tr>';
                                                $i++;
 }
                        }
                        $string.='</table><br />';
                        echo $string;
?>

