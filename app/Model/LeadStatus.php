<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model {
	// Open, Assigned, Reassigned, roconfirmed, confirmed, qchold, Reject
	protected $fillable = ['id','description', 'status', 'created_at', 'updated_at'];
}