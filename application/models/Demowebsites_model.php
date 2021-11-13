<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Demowebsites_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="category_details";
      public $PrimaryKey='id';
      protected $Filables=['web_name', 'web_photo', 'web_url','web_status','category_id','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
  function AddDemowebsites($demowebsitesarray)
	{
		$addresult=self::create($demowebsitesarray);
		return $addresult;
	} 


function EditDemowebsites($id)
	{
		$editresult=self::where('category_details.id','=',$id)->get();
		return $editresult;
	} 

function UpdateDemowebsites($demowebsitesarray, $campaign_id){

	$resultupdate=self::where('id','=',$campaign_id)->update($demowebsitesarray);
                return $resultupdate;

		}

function DeleteDemowebsites($id){

	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	}


function GetDemowebsitesForBusiness(){

		$datalistresult=self::join('categories','categories.id','=','category_details.category_id')->orderBy('id','desc')->limit(9)->get(['category_details.id','web_name','web_photo','web_url','category_name']);
		return $datalistresult;
	}

function SearchWebsiteforBusiness($business_website){

		 if($business_website){
			$category_id="\n AND category_details.category_id ='$business_website'";
		  }
		else{
			$category_id="";
		}
         $searchData=Capsule::select("SELECT category_details.id,web_name,web_photo,web_url,category_name
		from category_details
		join categories on categories.id=category_details.category_id  WHERE category_details.id !=0 ".$category_id ." ORDER BY id DESC LIMIT 9 ");     
	return $searchData;
	
	}

function ListDemowebsites($business_website){

		 if($business_website){
			$category_id="\n AND category_details.category_id ='$business_website'";
		  }
		else{
			$category_id="";
		}
        $searchData=Capsule::select("SELECT category_details.id,web_name,web_photo,web_url,category_name,web_status,CONCAT(user_details.first_name,' ',user_details.last_name) as employee_name,DATE_FORMAT(category_details.created_on,'%d-%m-%Y %h:%i:%s %p') as created_datetime
		from category_details
		join categories on categories.id=category_details.category_id 
		join user_details on user_details.user_id=category_details.created_by 
		WHERE category_details.id !=0 ".$category_id);     
	    return $searchData;
	
	}	


	function getDemowebsitesByCategory($business_website){

	   if($business_website){
			$category_id="\n AND category_details.category_id ='$business_website'";
		  }
		else{
			$category_id="";
		}
		
        $searchData=Capsule::select("SELECT category_details.id,web_name,web_photo,web_url,category_name,web_status
		from category_details
		join categories on categories.id=category_details.category_id  WHERE category_details.id !=0 AND category_details.web_status =1 ".$category_id);     
	   return $searchData;
	
	}


} 
?>