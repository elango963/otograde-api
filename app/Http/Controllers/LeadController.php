<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Model\Lead;
use App\Model\LeadClient;
use App\Model\LeadCustomerDetail;
use App\Model\ExecutiveDetail;
use App\Model\VehicleCategory;
use App\Model\ZipcodeListLodel;
use App\Http\Controllers\Controller;


class LeadController extends Controller
{

    public function __construct()
    {
        $this->request = app('request');
        $this->user = app('request')->attributes->get('user');
        $this->leadMdl = app()->make(Lead::class);
        $this->leadClientMdl = app()->make(LeadClient::class);
        $this->leadCustomerMdl = app()->make(LeadCustomerDetail::class);
        $this->executiveMdl = app()->make(ExecutiveDetail::class);
        $this->vehicleCategoryMdl = app()->make(VehicleCategory::class);
    }

    public function create() {
    	$returnData = $this->createPageInputData();

    	return $this->setStatusCode(200)->respond(["data" => $returnData]);
    }

    public function edit($id) {
    	
    	$returnData = $this->createPageInputData();
		/*** formData Sample ***/
    	$returnData["formData"] = [
    	 	"inspectionType" => "retail",
			"vehicleCategory" => "2wheeler",
			"registrationStatus" => "registered",
			"registrationNumber" => "132425244524",
			"loanAgreementNumber" => "eq133414134",
			"modelNumber" => "3124234123",
			"engineNumber" => "fasfsdf",
			"chassisNumber" => "4234dee",
			"numberOfOwners" => "3",
			"mfgDate" => "12/12/2019",
			"regDate" => "12/12/2019"
		];
		$returnData["formData"]["clients"] = [
			"clientName" => "CHOLAMANDALA",
			"clientState" => "ANDHRA PRADESH",
			"clientCity" => "ANANTAPUR"
		];
		$returnData["formData"]["customer"] = [
			"customerName" => "gopal",
			"customerMobileNumber" => "9486424140",
			"customerAddress1" => "gksjglsdbfadnflj",
			"customerAddress2" => "nkfnadjfadlfbka",
			"customerCity" => "chennai",
			"customerState" => "tamil nadu",
			"customerZipcode" => "606606"
		];

		$returnData["formData"]["executive"] = [
			"executiveName" => "anand",
			"executiveNumber" => "9486758674"
		];
		/*** formData Sample ***/
    	return $this->setStatusCode(200)->respond(["data" => $returnData]);
    }

    public function createPageInputData() {
    	$returnData = [];
    	// $returnData["clientName"] = $this->leadClientMdl->pluck("name");
    	// $returnData["vehicleCategory"] = $this->vehicleCategoryMdl->lists("description", "category");
    	// $this->zipcodeMdl = app()->make(ZipcodeListLodel::class);
    	// $returnData["zipcode"] = $this->zipcodeMdl->select("pincode", DB::raw('CONCAT(city, state) AS area'), "pincode")->lists("area", "pincode");
    	
    	/*** Dummy Data added ***/
    	$returnData["clientName"] = [
    		"CHOLAMANDALA",
    		"HDFC",
    		"MUTHOOT"
    	];
    	
    	$returnData["vehicleCategory"] = [
    		"2wheeler" => "2 Wheeler",
    		"fe" => "Farm Equipment",
    		"3wheeler" => "3 Wheeler",
    		"cv" => "Commercial Vehicle",
    		"4wheeler" => "4 Wheeler",
    		"ce" => "Construction Equipment"
    	];
    	$returnData["zipcode"] = [
    		"636303" => "salem, tamil nadu",
    		"606606" => "chennai, tamil nadu",
    		"600010" => "chennai, tamil nadu",
    		"600010" => "chennai, tamil nadu",
    		"600017" => "chennai, tamil nadu"
    	];
    	/*** Dummy Data added ***/
    	
    	$returnData["inspectionType"] = [
    		"retail" => "Retail",
    		"repo" => "Repo",
    		"c2c" => "C2C"
    	];

    	$returnData["registrationStatus"] = [
    		"registered" => "Registered",
    		"unregistered" => "Un Registered"
    	];
    	$returnData["ownersCountLimit"] = 10;
    	$returnData["state"] = config("citylist");

    	return $returnData;
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
        	$executiveexecutiveData['name'] = $data['executiveName'];
        	$executiveData['mobile'] = $data['executiveNumber'];
        	$executive = $this->executiveMdl->updateOrCreate(["mobile" => $executiveData['mobile']], $executiveData);
        	/*** Executive Details Insert End Here ***/

        	/*** Lead Id Creation Start Here ***/
        	$newLeadData['client_id'] = $client->id;
        	$newLeadData['inspection_type'] = $data['inspectionType'];
        	$newLeadData['vehicle_id'] = $data['vehicleId'];
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
        	$newLeadData['lead_status_id'] = 1; //Open
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
