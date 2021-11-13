<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
class BusinessCampaign_model extends Eloquent{
	
    public $timestamps = false;
    protected $table = "business_campaign"; // table name
    public $primaryKey = 'id';
    protected $fillable = ['business_id','campaign_id','business_package_id'];

	public function addBCampaign($campaignArray)
	{
		$addresult=self::create($campaignArray);
		
		return $addresult;
	} 
	
	public function deleteBCampaign($business_id)
	{
		$deleteresult=self::where('business_id','=',$business_id)->delete();
		return $deleteresult;
	}

	function getCampaignAmount($business_package_id)
	{
		$editresult=self::leftjoin('business_details','business_details.id','=','business_campaign.business_id')->join('campaigns','campaigns.id','=','business_campaign.campaign_id')->where('business_campaign.business_package_id','=',$business_package_id)->get(['business_campaign.business_id','campaign_name','campaign_amount','business_package_id']);
		return $editresult;
	}
	
}
?>