<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Query\Expression as raw;
class Userlogs_model extends Eloquent{
    public $timestamps = false;
    protected $guarded = array();
    protected $table = "user_logs"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['user_id', 'ip_address', 'login_datetime', 'logout_datetime', 'session_id', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

	public function addUserLogs($addarray)
	{
		$addresult=self::create($addarray);
		return $addresult;
	} 

	public function updateUserLogs($updatearray,$id)
	{
		$updateaddress=self::where('user_logs.session_id','=',$id)->update($updatearray);
		return $updateaddress;
	}

	function UserlogsDetailsById($id)
      {
		$addresult=self::join('users','users.id','=','user_logs.user_id')
		->join('user_details','user_details.user_id','=','users.id')
		->where('users.active','=','1')
		->where('user_logs.user_id','=',$id)
		->get(['user_logs.id','user_logs.login_datetime', 'user_logs.logout_datetime',new raw("TIMEDIFF( user_logs.logout_datetime,user_logs.login_datetime) as duration")]);
		return $addresult;
	}
	
}
?>

