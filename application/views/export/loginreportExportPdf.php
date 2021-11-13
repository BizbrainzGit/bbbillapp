<?php
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
                      <h3 style="text-align: center;">User LogIn Report</h3>
                            <table class="table">
                                  <thead style="background-color: #1c2c42;color: #ffffff">
                                    <tr>
                                        <th>S No.</th>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Designation</th>
                                        <th>Mobile No.</th>
                                        <th>last login Time</th>
                                      
                                      </tr>
                                  </thead>
                                  <tbody> ';
                             foreach ($data as $row){
                                        $id=$row->id;
                                        $user_id=$row->user_id;
                                        $user_name=$row->user_name;
                                        $mobileno=$row->mobileno;
                                        $designation=$row->designation;
                                        $last_login=$row->last_login;
                                        
                                 $string .=  '<tr class="text-right">
                                     <td> '.$id.'</td>
                                     <td>'.$user_id.'</td>
                                     <td>'.$user_name.'</td>
                                     <td>'.$designation.'</td>
                                     <td>'.$mobileno.'</td>
                                      <td>'.$last_login.'</td>
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

