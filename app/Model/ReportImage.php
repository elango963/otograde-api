<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model {

	protected $fillable = ['id', 'report_id', 'originalFileName', 'file_name', 'slug', 'created_at', 'updated_at'];
	
    public $rules = [
	    	'file' => 'required|max:1000',
            "slug" => "required",
            "originalFileName" => "required",
            "reportId" => "required"
	   	];
}