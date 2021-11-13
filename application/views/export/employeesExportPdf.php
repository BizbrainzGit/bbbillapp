<?php
$title="Employees List";
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
                <th width="15%"><strong>Full Name</strong> </th>
                <th width="10%"><strong>Email Id</strong></th>
                <th width="10%"><strong>Employee Id</strong></th>
                <th width="10%"><strong>Designation</strong></th>
                <th width="10%"><strong>Mobile No</strong> </th>
                <th width="15%"><strong>Aadhar No</strong></th>
                <th width="10%"><strong>City Name</strong></th>
                <th width="20%"><strong>address</strong> </th>
              
        </tr>';

        $i=0;
                        if(isset($data) && count($data)>0){
                                foreach ($data as $row){
                                        
                                        $id=$row->id;
                                        $name=$row->name;
                                        $email=$row->email;
                                        $username=$row->username;
                                        $designation=$row->designation;
                                        $mobileno=$row->mobileno;
                                        $aadharno=$row->aadharno;
                                        $cityname=$row->cityname;
                                        $address=$row->address;
                                       
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
                                                        <th><strong>Full Name</strong> </th>
                                                        <th><strong>Email Id</strong></th>
                                                        <th><strong>Appointment Date</strong></th>
                                                        <th><strong>Designation</strong></th>
                                                        <th><strong>Mobile No</strong> </th>
                                                        <th><strong>Aadhar No</strong></th>
                                                        <th><strong>City Name</strong></th>
                                                        <th><strong>address</strong> </th>
                                                      
                                                </tr>';
                                        }
                                         $string.='<tr valign="middle">
                                                <td width="5%">'.$id.'</td>
                                                <td width="15%">'.$name.'</td>
                                                <td width="10%">'.$email.'</td>
                                                <td width="10%">'.$designation.'</td>
                                                <td width="10%">'.$username.'</td>
                                                <td width="10%">'.$mobileno.'</td>
                                                <td width="15%">'.$aadharno.'</td>
                                                <td width="10%">'.$cityname.'</td>
                                                <td width="20%">'.$address.'</td>
                                              
                                                </tr>';
                                                $i++;
 }
                        }
                        $string.='</table><br />';
                        echo $string;
?>

