<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class SendLink_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="send_demolinks";
      public $PrimaryKey='id';
      protected $Filables=['company_name', 'contact_personname', 'mobileno', 'email', 'demo_link', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
		
  function AddDemolinks($demolinks){
		$addresult=self::create($demolinks);
		$addid=$addresult->id;
		return $addid;
		
	} 

 function listSendLinkData(){
		$addresult=self::join('users','users.id','=','send_demolinks.created_by')
		               ->join('user_details','user_details.user_id','=','users.id')
		               ->get(['send_demolinks.id','send_demolinks.company_name','contact_personname','send_demolinks.mobileno','send_demolinks.email', 'demo_link',new raw('DATE_FORMAT(send_demolinks.created_on, "%d-%m-%Y <br> %l:%i %p") as created_date'),new raw('CONCAT(user_details.first_name ," ",user_details.last_name) as user_name')]);
		return $addresult;
	}
 


} 
?>