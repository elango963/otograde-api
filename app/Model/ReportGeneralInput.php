<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportGeneralInput extends Model {

	protected $fillable = [];

    public function generalInputs()
    {
        return $this->hasOne('App\Model\Lead', 'lead_id');
    }

    public function generalInput($leadId)
    {
        return $this->where('lead_id', $leadId)->first();
    }
}