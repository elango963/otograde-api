<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model {
	protected $table = 'lead_status';
	protected $fillable = ['id','description', 'status', 'created_at', 'updated_at'];
}