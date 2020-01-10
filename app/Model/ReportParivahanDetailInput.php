<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportParivahanDetailInput extends Model {

	protected $guarded = [];

    public function parivahanDetails()
    {
        return $this->hasOne('App\Model\Lead', 'lead_id');
    }

    public function parivahanDetail($leadId)
    {
        return $this->where('lead_id', $leadId)->first();
    }
}