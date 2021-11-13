<?php
include_once(APPPATH . 'models/CommonBase_model.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class User extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $fillable = ['ip_address','username','password','email','activation_selector','activation_code','forgotten_password_code','forgotten_password_time','forgotten_password_selector','remember_selector','remember_code','created_on','last_login','active','first_name','last_name','company','phone','role_id'];
	


	public function UsersList()
	{
		$result=self::orderBy('username')->get();
		return $result;
	}
	public function MarketingUsersList()
	{
		$result=self::where('users.role_id','=',"2")->orWhere('users.role_id','=',"4")->orderBy('username')->get();
		return $result;
	}
	public function MarketLedUsersList()
	{
		$result=self::where('users.role_id','=',"4")->orderBy('username')->get();
		return $result;
	}

	public function userdetails() {
		return $this->hasOne('Userdetails_model','user_id');
	}
	
	public function address() {
		return $this->hasOne('Address_model','id','address_id')->select('id','address','street','city','state','country','pincode');
	}
	
	public static function userAccountsRole($id)
	{
		$userroledata = self::join('groups','groups.id','=','users.role_id')->where('users.id','=',$id)->select('users.id as user_id','role_id','groups.name')->get();
		return $userroledata;
	}
	
	
	public function userdetailsmin() {
		return $this->hasOne('Userdetails_model','user_id')->select(['first_name','last_name','mobileno','profile_pic_path']);
	}
	
	public static function findByEmail($email){
		
		$userdata = self::join('user_details','user_details.user_id','=','users.id')->where('email','=',$email)->get(['users.id','users.username','users.active','user_details.first_name','user_details.last_name']);
		return $userdata; 
	}
	public static function findById($id){
		
		$userdata = self::join('user_details','user_details.user_id','=','users.id')->where('users.id','=',$id)->get(['users.id','users.username','users.active','user_details.first_name','user_details.last_name']);
		return $userdata; 
	}
	
	public function getUserByIdData($user_id){
		try{
			$baseurl=getBaseURL(true);
			$userdata=self::join('user_details','user_details.user_id','=','users.id')
						->where('users.id',$user_id)
						->get(['users.id','users.email','users.username','users.active as status','user_details.first_name','user_details.last_name','user_details.mobileno',new raw('IF(user_details.profile_pic_path IS NULL OR user_details.profile_pic_path = "",NULL,concat("'.$baseurl.'","",user_details.profile_pic_path)) as profile_pic_path'),'user_details.address_id','user_details.dob','user_details.set_language','user_details.time_zone_id']);
			//$userdata=self::with('address')->find($user_id);
			
			return 	$userdata[0];		
		}
		catch(Exception $ex){
			throw new Exception($ex); //return false;
		}
	}
	public function updateUserData($data,$user_id){
		try{
			
		 return self::where('id','=',$user_id)->Update($data); 
		
		}
		catch(Exception $ex){
			throw new Exception($ex); //return false;
		}
	}
	
	public function getDobAttribute($value) {
		if ($value != null && $value != "0000-00-00" && $value != "0000-00-00 00:00:00"){
				return date("m/d/Y", strtotime($value));
		} else{
				return null;
		}
        
	}
	public function getUsersActiveList($account_id){
		$userdata=self::join('user_details','user_details.user_id','=','users.id')
						->join('user_accounts','user_accounts.user_id','=','users.id')
						->where('user_accounts.account_id','=',$account_id)
						->where('users.active',1)->get(['users.id','users.username','users.email',new raw('concat(user_details.first_name," ",user_details.last_name) as name')]);
		return $userdata;	
	}
	function deleteUserDataById($user_id){
		
		$userDelete=Capsule::Select("CALL sp_DeleteUser($user_id);");
		return $userDelete;
	}

	function deleteUserById($user_id){
		
		$userDelete=self::where('id','=',$user_id)->Delete();
		return $userDelete;
	}

	function updateStatus($statusarray,$employees_status_id){

	$resultupdate=self::where('id','=',$employees_status_id)->update($statusarray);
        return $resultupdate;

		}


 function listLoginReport()
      {
		$addresult=self::join('user_details','user_details.user_id','=','users.id')
		->join('groups','groups.id','=','users.role_id')
		->where('users.active','=','1')
		->get(['users.id',new raw('CONCAT(user_details.first_name ," ",user_details.last_name) as user_name'),'username as user_id','mobileno','email','designation',new raw("date_format(convert_tz(from_unixtime(last_login), '+00:00', '+05:30'), '%d-%m-%Y %l:%i %p') as last_login")]);
		return $addresult;
	}	

}
?>
