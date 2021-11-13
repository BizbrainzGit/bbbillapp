<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
class BusinessPaymentmode_model extends Eloquent{
	
    public $timestamps = false;
    protected $table = "business_paymentmode"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_id','payment_id'];

	public function addBPaymentmode($paymentArray)
	{
		$addresult=self::create($paymentArray);
		
		return $addresult;
	} 
	public function UpdateBPaymentmode($paymentArray)
	{
		$updateresult=self::create($paymentArray);
		return $updateresult;
	} 
	
	public function deleteBPaymentmode($business_id)
	{
		$deleteresult=self::where('business_id','=',$business_id)->delete();
		return $deleteresult;
	}
}
?>