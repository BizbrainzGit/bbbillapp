<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class GalleryType_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="gallerytypes";
      public $PrimaryKey='id';
      protected $Filables=['gallerytype_name', 'status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

  function AddGalleryTypes($gallerytypesarray)
	{
		$addresult=self::create($gallerytypesarray);
		return $addresult;
	} 

function editGalleryTypes($id)
	{
		$editresult=self::where('gallerytypes.id','=',$id)->get();
		return $editresult;
	} 
function UpdateGalleryTypes($gallerytypesarray, $gallerytype_id){

	$resultupdate=self::where('id','=',$gallerytype_id)->update($gallerytypesarray);
                return $resultupdate;

		}

function DeleteGalleryTypes($id){

	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	
        	}


function ListGalleryTypes()
	{
		$datalistresult=self::get(['gallerytypes.id','gallerytype_name','status']);
		return $datalistresult;
	}

function GalleryTypesget()
	{
		$datalistresult=self::where('status','=','1')->get(['gallerytypes.id','gallerytype_name','status']);
		return $datalistresult;
	}

function GalleryTypesForForntView()
	{
		$datalistresult=self::where('status','=','1')->get(['gallerytypes.id','gallerytype_name','status']);
		return $datalistresult;
	}	

 
} 
?>