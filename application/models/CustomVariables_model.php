<?php
include_once(APPPATH . 'models/CommonBase_model.php');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;

class CustomVariables_model extends CommonBase_model {
	public $timestamps = false;
	protected $table = 'custom_variables';
	protected $primaryKey = 'id';
	protected $fillable = ['custom_type','custom_variable','custom_fields','created_ip','created_by','created_on','modified_ip','modified_by','modified_on'];
}

?>