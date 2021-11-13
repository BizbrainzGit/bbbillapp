<?php 
 
use \Illuminate\Database\Eloquent\Model as Eloquent;
 
class MenuType_model extends Eloquent {
    public $timestamps = false;
    protected $table = "menu_type"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['menu_type_name'];
   

public function menuList()
	{
		$result=self::get();
		return $result;
	}













}
?>