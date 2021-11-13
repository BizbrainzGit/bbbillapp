<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class BusinessPackage_model extends Eloquent{
	
    public $timestamps = false;
    protected $table = "business_packages"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_id','package_id','business_package_id'];

	public function addBPackage($packageArray)
	{
		$addresult=self::create($packageArray);
		return $addresult;
	} 
	
	public function deleteBPackage($business_id)
	{
		$deleteresult=self::where('business_id','=',$business_id)->delete();
		return $deleteresult;
	}

	
     function getPackageAmount($order_id)
	{
		$result=self::join('business_details','business_details.id','=','business_packages.business_id')->join('packages','packages.id','=','business_packages.package_id')->join('packages_details','packages_details.id','=','business_packages.package_id')->where('business_packages.business_package_id','=',$order_id)->get(['business_packages.business_id','packages.package_name','package_amount']);
		return $result;
	}






	
}
