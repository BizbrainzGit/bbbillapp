 <?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class ProductType_model extends Eloquent {
    public $timestamps = false;
    protected $table = "products_types"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['product_type_name', 'product_type_status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

   function ProductTypeList()
	{
		$result=self::where('product_type_status','=',1)->orderBy('product_type_name')->get();
		return $result;
	}
	
	function SearchListProductTypes()
	{
		$datalistresult=self::get(['id','product_type_name','product_type_status']);
		return $datalistresult;
	}	

	 function AddProductType($producttypearray)
	{
		$addresult=self::create($producttypearray);		
		return $addresult;
	} 

	function EditProductType($id)
	{
		$editresult=self::where('id','=',$id)->get(['id','product_type_name','product_type_status']);
		return $editresult;
	} 

	function UpdateProductType($producttypearray, $producttype_id){

	    $resultupdate=self::where('id','=',$producttype_id)->update($producttypearray);
        return $resultupdate;

	}

	function DeleteProducttype($id){

	    $deleteresult=self::where('id','=',$id)->delete();
        return $deleteresult;
    }



	
 
}
?>