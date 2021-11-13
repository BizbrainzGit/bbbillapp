 <?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class PaymentType_model extends Eloquent {
    public $timestamps = false;
    protected $table = "payments_type"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['paymenttype_name', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
   

   public function PaymentTypeList()
	{
		$result=self::orderBy('paymenttype_name')->get();
		return $result;
	}
	function listPaymentsTypes()
	{
		$datalistresult=self::get(['id','paymenttype_name']);
		return $datalistresult;
	}	
	 function AddPaymenttype($paymenttypearray)
	{
		$addresult=self::create($paymenttypearray);		
		return $addresult;
	} 
	function EditPaymenttype($id)
	{
		$editresult=self::where('payments_type.id','=',$id)->groupBy('payments_type.id')->get(['payments_type.id','payments_type.paymenttype_name']);
		return $editresult;
	} 
	function UpdatePaymenttype($paymenttypearray, $paymenttype_id){

	    $resultupdate=self::where('id','=',$paymenttype_id)->update($paymenttypearray);
        return $resultupdate;

	}
	function DeletePaymenttype($id){

	    $deleteresult=self::where('id','=',$id)->delete();
        return $deleteresult;
    }



	
 
}
?>