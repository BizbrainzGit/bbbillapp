<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class PackagesDetails_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="packages_details";
      public $PrimaryKey='id';
      protected $Filables=['package_id','sub_package_id','created_date','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];


			
		
  function AddSubPackege($subpackagearray){
		$addresult=self::create($subpackagearray);
		return $addresult;
	} 

function DeletesubPackage($package_id){

	$deleteresult=self::where('package_id','=',$package_id)->delete();
    return $deleteresult;
        
 }

 
} 
?>