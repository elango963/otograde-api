<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExecutiveDetailModel extends Model {

	protected $fillable = ['id', 'name', 'mobile', 'created_at', 'updated_at'];
	
    public $rules = [
	    	'name' => 'required',
	    	'mobile' => 'required'
	   	];
}