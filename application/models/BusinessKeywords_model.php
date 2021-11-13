<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class BusinessKeywords_model extends Eloquent {
      public $timestamps=false;
      protected $guarded = array();
      protected $table="business_keywords";
      public $PrimaryKey='id';
      protected $Filables=['keywords','category_id','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
  function AddKeywords($businesskeywordsarray)
	{
		$addresult=self::create($businesskeywordsarray);
		return $addresult;
	} 


function editKeywords($id)
	{
		$editresult=self::where('business_keywords.id','=',$id)->get();
		return $editresult;
	} 

function ListKeywords()
	{
		$datalistresult=self::join('categories','categories.id','=','business_keywords.category_id')->orderBy('id','desc')->get(['business_keywords.id','keywords','category_name']);
		return $datalistresult;
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
		$datalistresult=self::join('categories','categories.id','=','business_keywords.category_id')->get(['business_keywords.id','keywords','category_name']);
		return $datalistresult;
	}


function SearchBusinessKeywordsforBusiness($business_keyword){


		 if($business_keyword){
		
			$category_id="\n AND business_keywords.category_id ='$business_keyword'";
			
		}
		else{
			$category_id=" ";
		}

         $searchData=Capsule::select("SELECT business_keywords.id,keywords,category_name
		from business_keywords
		join categories on categories.id=business_keywords.category_id  WHERE business_keywords.id !=0 ".$category_id);     
	return $searchData;
	
	}

} 
?>