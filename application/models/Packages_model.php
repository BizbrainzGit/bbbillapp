<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Packages_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="packages";
      public $PrimaryKey='id';
      protected $Filables=['package_name', 'package_amount','package_status','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
  function AddPackage($packagesarray)
	{
		$addresult=self::create($packagesarray);
		$id=$addresult->id;
		return $id;
	} 


function listPackages()
	{
		$datalistresult=self::get(['id','package_name','package_amount','package_status']);
		return $datalistresult;
	}	

function EditPackage($id)
	{
		$editresult=self::join('packages_details','packages_details.package_id','=','packages.id')->Join('sub_packages','sub_packages.id','=','packages_details.sub_package_id')->where('packages.id','=',$id)->groupBy('packages.id')->get(['packages.id','packages.package_name','packages.package_amount','package_status', new raw('GROUP_CONCAT(DISTINCT(sub_package_id)) as sub_package_id'),new raw('GROUP_CONCAT(DISTINCT(sublist_name)) as sublist_name')]);
		return $editresult;
	}

function UpdatePackage($packagearray, $package_id){

	$resultupdate=self::where('id','=',$package_id)->update($packagearray);
                return $resultupdate;

		}

function DeletePackage($id){
	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	}


function GetPackageForBusinessCustomer()
	{
		$datalistresult=self::Join('packages_details','packages_details.package_id','=','packages.id')->Join('sub_packages','sub_packages.id','=','packages_details.sub_package_id')->where('package_status','=',3)->groupBy('packages.id')->orderBy('packages.id', 'ASC')->get(['packages.id','package_name','package_amount',new raw('GROUP_CONCAT(DISTINCT(sublist_name)) as sublist_name')]);
		return $datalistresult;
	}


function GetPackageForBusiness()
	{
		$datalistresult=self::Join('packages_details','packages_details.package_id','=','packages.id')->Join('sub_packages','sub_packages.id','=','packages_details.sub_package_id')->where('package_status','=',1)->orwhere('package_status','=',3)->groupBy('packages.id')->orderBy('packages.id', 'ASC')->get(['packages.id','package_name','package_amount',new raw('GROUP_CONCAT(DISTINCT(sublist_name)) as sublist_name')]);
		return $datalistresult;
	}

	function listPackagesForFrontend()
	{
		$datalistresult=self::where('package_status','=',1)->orwhere('package_status','=',3)->orderBy('packages.id', 'DESC')->get(['id','package_name','package_amount','package_status']);
		return $datalistresult;
	}
  
  function getPackageForFrontend()
	{
		$datalistresult=self::Join('packages_details','packages_details.package_id','=','packages.id')->Join('sub_packages','sub_packages.id','=','packages_details.sub_package_id')->where('package_status','=',3)->groupBy('packages.id')->orderBy('packages.id', 'ASC')->get(['packages.id','package_name','package_amount',new raw('GROUP_CONCAT(DISTINCT(sublist_name)) as sublist_name')]);
		return $datalistresult;
	}


} 
?>