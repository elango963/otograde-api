<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model {

	 protected $table = 'vehicle_category';
	 
	protected $fillable = ['id', 'category', 'description', 'created_at', 'updated_at'];
	
    public $rules = [
	    	'vehicleCategory' => 'required|in:2wheeler,3wheeler,4wheeler,fe,cv,ce'
	   	];
}