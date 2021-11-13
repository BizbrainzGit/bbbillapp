<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Query\Expression as raw;
class BusinessOwner_model extends Eloquent{
	
    public $timestamps = false;
     protected $guarded = array();
    protected $table = "business_owners"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_id', 'owner_name', 'owner_role', 'owner_mobile', 'owner_email'];

    

	public function addBusinessowner($businessownersarray)
	{
		$createbusiness_owners=self::create($businessownersarray);
		$business_ownersid=$createbusiness_owners->id;
		return $business_ownersid;
	} 
	public function deleteBusinessowner($business_id)
	{
		$deletebusiness_owners=self::where('business_owners.business_id','=',$business_id)->delete();
		return $deletebusiness_owners;
	} 

	public function editBusinessowner($id)
	{
		$deletebusiness_owners=self::where('business_owners.business_id','=',$id)->get( ['business_id', 'owner_name', 'owner_role', 'owner_mobile', 'owner_email']);
		return $deletebusiness_owners;
	} 
	
}
?>

