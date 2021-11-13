<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class Status_model extends Eloquent {
    public $timestamps = false;
    protected $table = "business_status"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['status_value'];
   

   public function StatusList()
	{
		$result=self::orderBy('status_value')->get();
		return $result;
	}
	public function StatusWithOutDealClosedList()
	{
		$result=self::whereNOTIn('id',array(4,15))->orderBy('status_value', 'ASC')->get();
		return $result;
	}

	public function StatusListForTelemarketingBForm()
	{
		 $result=self::whereIn('id',array(11,15))->orderBy('status_value', 'ASC')->get();
		 return $result;
	}
	
 
}
?>