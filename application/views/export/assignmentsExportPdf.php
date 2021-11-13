<?php
$title="Assignments List";
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
                <th width="15%"><strong>Company Name</strong> </th>
                <th width="10%"><strong>Message</strong></th>
                <th width="10%"><strong>Appointment Date Time</strong></th>
                <th width="10%"><strong>Marketing Name</strong></th>
                <th width="10%"><strong>Work Assigned Date</strong> </th>
                <th width="15%"><strong>Assigned By Tele-caller</strong></th>
                <th width="10%"><strong>Assigned By MarketLead</strong></th>
                <th width="10%"><strong>Status Message</strong> </th>
                <th width="15%"><strong>Status Updated On</strong></th>
                <th width="10%"><strong>Status</strong></th>
              
        </tr>';

        $i=0;
                        if(isset($data) && count($data)>0){
                                foreach ($data as $row){
                                        
                                        $id=$row->id;
                                        $company_name=$row->company_name_id;
                                        $person_name=$row->person_name_mobile;
                                        $message=$row->message;
                                        $appointment_datetime=$row->appointment_datetime;
                                        $marketing_name=$row->marketing_name;
                                        $work_assigned_date=$row->work_assigned_date;
                                        $tele_name=$row->tele_name;
                                        $marketlead_name=$row->marketlead_name;
                                        $marketing_message=$row->marketing_message;
                                        $assignmentmsg_datetime=$row->assignmentmsg_datetime;
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
                                                         <th><strong>Person Name</strong> </th>
                                                        <th><strong>Message</strong></th>
                                                        <th><strong>Appointment Date</strong></th>
                                                        <th><strong>Marketing Name</strong></th>
                                                        <th><strong>Work Assigned Date</strong> </th>
                                                        <th><strong>Assigned By Tele-caller</strong></th>
                                                        <th><strong>Assigned By MarketLead</strong></th>
                                                        <th><strong>Status Message</strong> </th>
                                                        <th><strong>Status Updated On</strong></th>
                                                        <th><strong>Status</strong></th>
                                                       
                                                        
                                                </tr>';
                                        }
                                         $string.='<tr valign="middle">
                                                <td width="5%">'.$id.'</td>
                                                <td width="15%">'.$company_name.'</td>
                                                <td width="15%">'.$person_name.'</td>
                                                <td width="10%">'.$message.'</td>
                                                <td width="10%">'.$marketing_name.'</td>
                                                <td width="10%">'.$appointment_datetime.'</td>
                                                <td width="10%">'.$work_assigned_date.'</td>
                                                <td width="15%">'.$tele_name.'</td>
                                                <td width="10%">'.$marketlead_name.'</td>
                                                <td width="10%">'.$marketing_message.'</td>
                                                <td width="15%">'.$assignmentmsg_datetime.'</td>
                                                <td width="10%">'.$status_value.'</td>
                                                </tr>';
                                                $i++;
 }
                        }
                        $string.='</table><br />';
                        echo $string;
?>

