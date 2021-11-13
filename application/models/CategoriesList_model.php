<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class CategoriesList_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="categories";
      public $PrimaryKey='id';
      protected $Filables=['category_name','status','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
		
		
  public function CategoriesList()
	{
		$result=self::get();
		return $result;
	} 

  function AddKeywords($businesskeywordsarray)
	{
		$addresult=self::create($businesskeywordsarray);
		return $addresult;
	} 

function editKeywords($id)
	{
		$editresult=self::where('categories.id','=',$id)->get();
		return $editresult;
	} 
function UpdateKeywords($businesskeywordsarray, $keywords_id){

	$resultupdate=self::where('id','=',$keywords_id)->update($businesskeywordsarray);
                return $resultupdate;

		}

function DeleteKeywords($id){

	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	
        	}


function ListKeyWordForBusiness()
	{
		$datalistresult=self::orderBy('id', 'desc')->get(['categories.id','category_name']);
		return $datalistresult;
	}


function SearchBusinessKeywords($business_keyword,$business_status){

		 if($business_keyword){
		
			$category_id="\n AND categories.category_name  like'%$business_keyword%'";
		  }
		else{
		 	$category_id=" ";
		   }
		   if($business_status){
		
			$status_id="\n AND categories.status ='$business_status'";
		  }
		else{
		 	$status_id=" ";
		   } 

         $searchData=Capsule::select("SELECT categories.id,category_name,status from categories WHERE categories.id !=0 ".$category_id.$status_id);     
	 
	 return $searchData;
	
	}

	function SearchBusinessKeywordsforBusiness($business_keyword){

		 if($business_keyword){
		
			$category_id="\n AND categories.category_name  like'%$business_keyword%'";
		  }
		else{
		 	$category_id=" ";
		   }

         $searchData=Capsule::select("SELECT categories.id,category_name,status from categories WHERE categories.id !=0 AND status=1 ".$category_id);     
	 
	 return $searchData;
	
	}


 
} 
?>