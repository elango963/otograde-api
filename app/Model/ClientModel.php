<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model {

	protected $fillable = ['id','short_name', 'name', 'city', 'state', 'created_at', 'updated_at'];
	
    public $rules = [
	    	'name' => 'required',
	    	'city' => 'required',
	    	'state' => 'required'
	   	];
}