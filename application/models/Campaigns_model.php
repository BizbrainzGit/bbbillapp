<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Campaigns_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="campaigns";
      public $PrimaryKey='id';
      protected $Filables=['campaign_name', 'campaign_photo', 'campaign_amount', 'status', 'category_id','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];
	
  function AddCampaign($campaignsarray)
	{
		$addresult=self::create($campaignsarray);
		return $addresult;
	} 


function EditCampaign($id)
	{
		$editresult=self::where('campaigns.id','=',$id)->get();
		return $editresult;
	} 

function ListCampaign()
	{
		$datalistresult=self::get(['campaigns.id','campaign_name', 'campaign_photo','campaign_amount', 'status']);
		return $datalistresult;
	}	

function UpdateCampaign($campaignsarray, $campaign_id){

	$resultupdate=self::where('id','=',$campaign_id)->update($campaignsarray);
                return $resultupdate;

		}

function DeleteCampaign($id){

	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	}


function GetAmountBCampaign($campaign_id)
	{
		$datalistresult=self::where('id','=',$campaign_id)->get(['campaign_name','campaign_amount']);
		return $datalistresult;
	}

function ListCampaignForBusiness()
	{
		$datalistresult=self::Where('category_id','=',1)->Where('status','=',1)->get(['campaigns.id','campaign_name', 'campaign_photo','campaign_amount']);
		return $datalistresult;
	}

function ListCampaignERPForBusiness()
	{
		$datalistresult=self::Where('category_id','=',2)->Where('status','=',1)->get(['campaigns.id','campaign_name', 'campaign_photo','campaign_amount']);
		return $datalistresult;
	}	



} 
?>