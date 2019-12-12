<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Model\LeadModel;


class LeadController extends Controller
{
	public function create(Request $request, LeadModel $leadModel) {
		$error = $this->validator($request, $leadModel->rules);
        if ($error !== false) {
            
            return $error;
        } else {
	    	$vehileSource = findVehicle("GP");
	    	print_r($vehileSource);exit;
	    }
	}
  
}
