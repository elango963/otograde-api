<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportReviewsInput extends Model {

	protected $guarded = [];

    public function reviews()
    {
        return $this->hasOne('App\Model\Lead', 'lead_id');
    }

    public function review($leadId)
    {
        return $this->where('lead_id', $leadId)->first();
    }
}