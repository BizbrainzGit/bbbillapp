<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class Menu_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="menus";
      public $PrimaryKey='id';
      protected $Filables=['menu_name', 'menu_urlname','menu_titletag', 'menu_metakeyword', 'menu_metadescription', 'status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];



  function AddMenus($menusarray)
	{
		$addresult=self::create($menusarray);
		return $addresult;
	} 

function editMenus($id)
	{
		$editresult=self::where('menus.id','=',$id)->get();
		return $editresult;
	} 
function UpdateMenus($menusarray, $menu_id){

	$resultupdate=self::where('id','=',$menu_id)->update($menusarray);
                return $resultupdate;

		}

function DeleteMenus($id){

	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	
        	}


function ListMenus()
	{
		$datalistresult=self::get(['menus.id','menu_name','status']);
		return $datalistresult;
	}

function Menusget()
	{
		$datalistresult=self::where('status','=','1')->get(['menus.id','menu_name','status']);
		return $datalistresult;
	}

// function MenusgetForMetaDataToForntView()
// 	{
// 		$datalistresult=self::where('status','=','1')->get(['menus.id','menu_name', 'menu_titletag', 'menu_metakeyword', 'menu_metadescription','menu_urlname']);
// 		return $datalistresult;
// 	}
	
  function MenusgetForMetaDataToForntView($metamenuid)
	{
		$datalistresult=self::where('menu_urlname','=',$metamenuid)->where('status','=','1')->get(['menus.id','menu_name', 'menu_titletag', 'menu_metakeyword', 'menu_metadescription','menu_urlname']);
		return $datalistresult;
	}

 
} 
?>