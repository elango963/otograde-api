<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportImage extends Model {

	protected $fillable = ['id', 'lead_id', 'report_id', 'slug', 'label', 'file_name','file_path', 'created_at', 'updated_at'];
	
    public $rules = [
	    	'file' => 'required|max:1000',
            "slug" => "required",
            "originalFileName" => "required",
            "leadId" => "required"
	   	];

    public function reportImage($leadId)
    {
        return $this->where('lead_id', $leadId)->select('lead_id', 'report_id', 'slug', 'label', 'file_name','file_path')->get();
    }
}