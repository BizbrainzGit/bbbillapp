<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class JobSkill_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="jobskills";
      public $PrimaryKey='id';
      protected $Filables=['jobskill_name', 'status', 'created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

  function AddJobSkills($jobskillsarray)
	{
		$addresult=self::create($jobskillsarray);
		return $addresult;
	} 

function editJobSkills($id)
	{
		$editresult=self::where('jobskills.id','=',$id)->get();
		return $editresult;
	} 
function UpdateJobSkills($jobskillsarray, $jobskill_id){

	$resultupdate=self::where('id','=',$jobskill_id)->update($jobskillsarray);
                return $resultupdate;

		}

function DeleteJobSkills($id){

	$deleteresult=self::where('id','=',$id)->delete();
    return $deleteresult;
        	
        	}


function ListJobSkills()
	{
		$datalistresult=self::get(['jobskills.id','jobskill_name','status']);
		return $datalistresult;
	}

function JobSkillsget()
	{
		$datalistresult=self::where('status','=','1')->get(['jobskills.id','jobskill_name','status']);
		return $datalistresult;
	}

	

 
} 
?>