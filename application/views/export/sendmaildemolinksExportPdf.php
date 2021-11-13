<?php
$title="Invoice";
$logo="https://devapp.adzbill.in/assets/images/BB_Final_1.JPG";
if($print==1){ $noofrows=12;}else{ $noofrows=20;}
  $string='';

        if(isset($data) && count($data)>0){ 
                
                                       
                               
                                        
           

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


                    
                      <div class="fullwidth" >
                            <table class="table">
                                  <thead style="background-color: #1c2c42;color: #ffffff">
                                    <tr>
                                        <th>S No</th>
                                        <th>Business Name</th>
                                        <th>Business Email</th>
                                        <th>Email Subject</th>
                                        <th>User Name</th>
                                        <th>Designation</th>
                                        <th>Email Sending Date</th>
                                      </tr>
                                  </thead>
                                  <tbody> ';
                             foreach ($data as $row){
                                        $id=$row->id;
                                        $company_name=$row->company_name;
                                        $to_email=$row->to_email;
                                        $subject=$row->subject;
                                        $user_name=$row->user_name;
                                        $designation=$row->designation;
                                        $sending_datetime=$row->sending_datetime;
                                        
                                 $string .=  '<tr class="text-right">
                                     <td> '.$id.'</td>
                                     <td>'.$company_name.'</td>
                                     <td>'.$to_email.'</td>
                                     <td>'.$subject.'</td>
                                     <td>'.$user_name.'</td>
                                      <td>'.$designation.'</td>
                                     <td>'.$sending_datetime.'</td>
                                     </tr>';
                                   }
                               $string .=   '</tbody>
                            </table>
                        </div>
                        
                 </div>
              </div> ';

            
}
  echo $string; 

?>

