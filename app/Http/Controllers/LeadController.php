<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Model\LeadModel;
use App\Model\LeadClientModel;
use App\Model\LeadCustomerDetailModel;
use App\Model\ExecutiveDetailModel;
use App\Model\VehicleCategoryModel;
use App\Model\ZipcodeListLodel;
use App\Http\Controllers\Controller;


class LeadController extends Controller
{

    public function __construct()
    {
        $this->request = app('request');
        $this->user = app('request')->attributes->get('user');
        $this->leadMdl = app()->make(LeadModel::class);
        $this->leadClientMdl = app()->make(LeadClientModel::class);
        $this->leadCustomerMdl = app()->make(LeadCustomerDetailModel::class);
        $this->executiveMdl = app()->make(ExecutiveDetailModel::class);
        $this->vehicleCategoryMdl = app()->make(VehicleCategoryModel::class);
    }

    public function create() {
    	$returnData = [];
    	// $returnData["clientName"] = $this->leadClientMdl->pluck("name");
    	// $returnData["vehicleCategory"] = $this->vehicleCategoryMdl->lists("description", "category");
    	// $this->zipcodeMdl = app()->make(ZipcodeListLodel::class);
    	// $returnData["zipcode"] = $this->zipcodeMdl->select("pincode", DB::raw('CONCAT(city, state) AS area'), "pincode")->lists("area", "pincode");
    	$returnData["zipcode"] = [
    		"636303" => "salem, tamil nadu",
    		"600100" => "chennai, tamil nadu",
    		"600010" => "chennai, tamil nadu",
    		"600017" => "chennai, tamil nadu"
    	];
    	$returnData["clientName"] = [
    		"CHOLAMANDALA",
    		"HDFC",
    		"MUTHOOT"
    	];
    	$returnData["inspectionType"] = [
    		"retail" => "Retail",
    		"repo" => "Repo",
    		"c2c" => "C2C"
    	];
    	$returnData["vehicleCategory"] = [
    		"2wheeler" => "2 Wheeler",
    		"3wheeler" => "3 Wheeler",
    		"4wheeler" => "4 Wheeler",
    		"fe" => "Farm Equipment",
    		"cv" => "Commercial Vehicle",
    		"ce" => "Construction Equipment"
    	];
    	$returnData["registrationStatus"] = [
    		"registered" => "Registered",
    		"unregistered" => "Un Registered"
    	];
    	$returnData["ownersCountLimit"] = 10;
    	$returnData["state"] = config("citylist");
    	// $leadList = $this->leadMdl->where("status_id", 1)->get();

    	return $this->setStatusCode(200)->respond(["data" => $returnData]);
    }

    public function inbox() {
    	$leadList = $this->leadMdl->where("status_id", 1)->get();

    	return $this->setStatusCode(200)->respond($leadList);
    }

	public function save() {
		$error = $this->validator($this->request, $this->leadMdl->rules);
        if ($error !== false) {
            
            return $error;
        } else {
        	$data = $this->request->all();
        	/*** Client Details Insert Start Here ***/
        	$clientData['name'] = $data['clientName'];
        	$clientData['city'] = $data['clientCity'];
        	$clientData['state'] = $data['clientState'];
        	$clientData['short_name'] =  substr($clientData['name'], 0, 5);
        	$client = $this->leadClientMdl->create($clientData);
        	/*** Client Details Insert End Here ***/

        	/*** Customer Details Insert Start Here ***/
        	$customerData['name'] = $data['customerName'];
        	$customerData['mobile'] = $data['customerMobileNumber'];
        	$customerData['address1'] = $data['customerAddress1'];
        	$customerData['address2'] = $data['customerAddress2'];
        	$customerData['city'] = $data['customerCity'];
        	$customerData['state'] = $data['customerState'];
        	$customerData['pincode'] = $data['customerZipcode'];
        	$customer = $this->leadCustomerMdl->create($customerData);
        	/*** Customer Details Insert End Here ***/

        	/*** Executive Details Insert Start Here ***/
        	$executiveData['name'] = $data['executiveName'];
        	$executiveData['mobile'] = $data['executiveNumber'];
        	$executive = $this->executiveMdl->updateOrCreate(["mobile" => $executiveData['mobile']], $executiveData);
        	/*** Executive Details Insert End Here ***/

        	/*** Lead Id Creation Start Here ***/
        	$newLeadData['client_id'] = $client->id;
        	$newLeadData['inspection_type'] = $data['inspectionType'];
        	$newLeadData['vehicle_id'] = $data['vehicleId'];
        	$newLeadData['registration_type'] = $data['registrationType'];
        	$newLeadData['registration_number'] = $data['registrationNumber'];
        	$newLeadData['loan_agreement_number'] = $data['loanAgreementNumber'];
        	$newLeadData['model_number'] = $data['modelNumber'];
        	$newLeadData['engine_number'] = $data['engineNumber'];
        	$newLeadData['chassis_number'] = $data['chassisNumber'];
        	$newLeadData['number_of_owners'] = $data['numberOfOwners'];
        	$newLeadData['registration_status'] = $data['registrationStatus'];
        	$newLeadData['mfg_date'] = $data['mfgDate'];
        	$newLeadData['reg_date'] = $data['regDate'];
        	$newLeadData['executive_id'] = $executive->id;
        	$newLead = $this->leadMdl->create($newLeadData);
            \Log::info($newLead);
	    	$vehileSource = findVehicle($data['vehicleCategory']);
	    	$newLeadId = $newLead->id;
	    	if (strlen($newLeadId) > 3) {
	    		$newLeadId = substr('000'.$newLeadId, -3);
	    	}

	    	$newLead->lead_id = $clientData['short_name'].$vehileSource.$newLeadId;
	    	$newLead->save();
	    	/*** Lead Id Creation End Here ***/
	    	
	    	$client->lead_id = $newLead->lead_id;
	    	$client->save();
			
			$customer->lead_id = $newLead->lead_id;
			$customer->save();

	    	$data["status"] = "success";
	    	$data["lead"] = $newLead->first();

	    	return $this->setStatusCode(200)->respond($data);
	    }
	}
  
}
