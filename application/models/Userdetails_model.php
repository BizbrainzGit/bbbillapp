<?php
include_once(APPPATH . 'models/CommonBase_model.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class Userdetails_model extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'user_details';
	protected $primaryKey = 'id';
	protected $fillable = ['user_id','first_name','last_name','mobileno','aadharno','dob','profile_pic_path','address_id','device_token','device_type','city_id','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	
	public function addUserDetails($userdetailsarray){
		try{
			$userDetailsId = self::create($userdetailsarray)->id;
			return $userDetailsId;
		}
		catch(Exception $ex){
			throw new Exception($ex);	
		}
	}
	function updateUserDetails($data,$user_id)
	{
		try{
			
		 return self::where('user_id','=',$user_id)->Update($data); 
		
		}
		catch(Exception $ex){
			throw new Exception($ex); //return false;
		}
		
	}
	public function addressInfo() {
		return $this->hasOne('Address_model','id','address_id')->select('house_no', 'street', 'sub_area', 'area', 'landmark', 'city_id', 'state_id', 'country', 'pincode');
	}
	
	function getAuthTokenResult($auth_token){
		$authtokencount=Capsule::Select("select count(*) as count,user_id from `user_details` where `auth_token`='".$auth_token."'");
		return $authtokencount[0];
	}
	function getAuthToken($user_id){
		$auth_token = self::where('user_id',$user_id)->first()->auth_token;
		if(isset($auth_token) && strlen($auth_token)>0){
			return $auth_token;
		}else{
			return null;
		}
	}

   
  public function AllUsers()
	{
		$listresult = self::join('address','address.id','=','user_details.address_id')
		->join('users','users.id','=','user_details.user_id') 
		->join('groups','groups.id','=','users.role_id')
		->where('users.active','=','1')
		->get(['user_details.first_name','user_details.last_name','users.id','designation']);
		return $listresult;
		
	} 

public function EditEmployees($id)
	{
		$listresult = self::join('address','address.id','=','user_details.address_id')
		->join('users','users.id','=','user_details.user_id')
        ->where('user_details.id','=',$id)
		->get(['user_details.first_name','user_details.last_name','users.username','users.email','users.active','users.role_id','user_details.mobileno','user_details.aadharno','user_details.id', 'user_details.user_id','user_details.address_id','user_details.profile_pic_path','house_no', 'street', 'sub_area', 'area', 'landmark', 'address.city_id', 'state_id', 'country', 'pincode']);
		
		return $listresult;
		
	}

function DeleteEmployees($id)
	{
	
			$deleteresult= self::where('user_details.id','=',$id)->delete();
		     
		     return$deleteresult; 
	}

function SearchEmployee($employee_name,$employee_city,$employee_mobileno, $employee_designation){
             
       
		if($employee_name!=''){
		
			$employeename="\n AND user_details.first_name like '%$employee_name%'";
		}
		else{
			$employeename="";
		}

		if($employee_city!=''){
		
			$cityname="\n AND address.city_id ='$employee_city'";
		}
		else{
			$cityname="";
		}

		if($employee_mobileno!=''){
		
			$mobileno="\n AND user_details.mobileno like '%$employee_mobileno%'";
		}
		else{
			$mobileno="";
		}

		if($employee_designation!=''){
		
			$designation="\n AND users.role_id ='$employee_designation'";
		}
		else{
			$designation="";
		}
		
       
$searchData=Capsule::select("SELECT Concat(user_details.first_name,'',user_details.last_name) as name,users.email,users.active,users.username,user_details.mobileno,user_details.aadharno,user_details.id, user_details.user_id,user_details.address_id,user_details.profile_pic_path,house_no,street,sub_area,area, landmark,pincode,cityname,state_name,designation from user_details

	    join address on address.id=user_details.address_id
		join users on users.id=user_details.user_id
		join groups on groups.id=users.role_id
		left join states on states.state_id=address.state_id
		left join cities on cities.cityid=address.city_id

		WHERE user_details.id !=0 ".$employeename.$mobileno.$cityname.$designation);     
	return $searchData;		

	}

function EmployeesExportForAdmin(){
             
$searchData=Capsule::select("SELECT Concat(user_details.first_name,'',user_details.last_name) as name,users.email,users.active,users.username,user_details.mobileno,user_details.aadharno,user_details.id, user_details.user_id,user_details.address_id,user_details.profile_pic_path,house_no,street,sub_area,area, landmark,pincode,cityname,state_name,designation ,Concat(house_no,', ',street,', ',sub_area,area,', ',landmark,', ',cityname,', ',state_name,', ',pincode) as address from user_details

	    join address on address.id=user_details.address_id
		join users on users.id=user_details.user_id
		join groups on groups.id=users.role_id
		left join states on states.state_id=address.state_id
		left join cities on cities.cityid=address.city_id
		WHERE user_details.id !=0 ");     
	return $searchData;		

	}



	
 public function  getdetailsForSms($id){
                
                    $listresult = self::join('address','address.id','=','user_details.address_id')
		             ->join('users','users.id','=','user_details.user_id')
                     ->where('user_details.user_id','=',$id)
		             ->get(['user_details.first_name','user_details.last_name','users.username','users.email','users.active','users.role_id','user_details.mobileno','user_details.id', 'user_details.user_id','user_details.address_id','user_details.profile_pic_path','house_no', 'street', 'sub_area', 'area', 'landmark', 'address.city_id', 'state_id', 'country', 'pincode']);

             return$listresult[0]; 
                 }

}

?>