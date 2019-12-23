<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ZipcodeList extends Model {

	protected $fillable = ['id', 'zipcode', 'city', 'state', 'created_at'];
}