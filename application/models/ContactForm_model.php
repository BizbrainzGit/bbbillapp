<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent ;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Query\Expression as raw;
class ContactForm_model extends Eloquent {
	
      public $timestamps=false;
      protected $guarded = array();
      protected $table="contact_form";
      public $PrimaryKey='id';
      protected $Filables=['name', 'email', 'mobile_no','company_name','message','created_ip', 'created_by', 'created_on', 'modified_ip', 'modified_by', 'modified_on'];

  function AddContactFormDetails($contactformarray)
	{
		$addresult=self::create($contactformarray);
		return $addresult;
	} 
 function ListContactFormDetails()
 {
   $datalistresult=self::get(['contact_form.id','name', 'email', 'mobile_no','company_name','message', new raw('DATE_FORMAT(created_on, "%d-%m-%Y <br> %l:%i %p") as created_date')]);
   return $datalistresult;
 }

 
} 
?>