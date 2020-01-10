<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReportTestDriveInput extends Model {

	protected $guarded = [];

    public function testDrives()
    {
        return $this->hasOne('App\Model\Lead', 'lead_id');
    }

    public function testDrive($leadId)
    {
        return $this->where('lead_id', $leadId)->first();
    }
}