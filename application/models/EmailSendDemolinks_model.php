<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class EmailSendDemolinks_model extends Eloquent {
      public $timestamps=false;
      protected $guarded = array();
      protected $table="send_emails";
      public $PrimaryKey='id';
      protected $Filables=['to_email', 'from_email', 'sender_user_id', 'business_gform_id', 'subject', 'message', 'created_by', 'created_on', 'created_ip'];

  function EmailSendDemolinksSave($emaildemolinksarray){
		$addresult=self::create($emaildemolinksarray);
		return $addresult;
	   } 

  function EmailSendDemolinksList(){

    $listresult=self::join('users','users.id','=','send_emails.sender_user_id')
                     ->join('gform_data','gform_data.id','=','send_emails.business_gform_id')
                     ->join('user_details','user_details.user_id','=','users.id')
                     ->join ('groups','groups.id','=','users.role_id')
                     ->get(['send_emails.id','to_email', 'from_email', 'sender_user_id','subject',new raw('CONCAT(user_details.first_name ,"",user_details.last_name) as user_name'),new raw('DATE_FORMAT(send_emails.created_on, "%d-%m-%Y:%l:%i:%p") as sending_datetime'),'designation','company_name']);
    return $listresult;

     } 

 

} 
?>