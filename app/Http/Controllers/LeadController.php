<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Model\LeadModel;
use App\Model\ClientModel;
use App\Model\CustomerDetailModel;
use App\Model\ExecutiveDetailModel;
use App\Http\Controllers\Controller;


class LeadController extends Controller
{

    public function __construct()
    {
        $this->request = app('request');
        $this->user = app('request')->attributes->get('user');
        $this->leadMdl = app()->make(LeadModel::class);
        $this->clientMdl = app()->make(ClientModel::class);
        $this->customerMdl = app()->make(CustomerDetailModel::class);
        $this->executiveMdl = app()->make(ExecutiveDetailModel::class);
    }

    public function list() {
    	$leadList = $this->leadMdl->where("status_id", 1)->get();
    	
    	return $this->setStatusCode(200)->respond($leadList);
    }


	public function create() {
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
        	$client = $this->clientMdl->create($clientData);
        	/*** Client Details Insert End Here ***/

        	/*** Customer Details Insert Start Here ***/
        	$customerData['name'] = $data['customerName'];
        	$customerData['mobile'] = $data['customerMobileNumber'];
        	$customerData['address1'] = $data['customerAddress1'];
        	$customerData['address2'] = $data['customerAddress2'];
        	$customerData['city'] = $data['customerCity'];
        	$customerData['state'] = $data['customerState'];
        	$customerData['pincode'] = $data['customerZipcode'];
        	$customer = $this->customerMdl->create($customerData);
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
        	$newLead = $this->leadMdl->create([]);
	    	$vehileSource = findVehicle($data['vehicleCategory']);
	    	$newLeadId = $newLead->id;
	    	if (strlen($newId) > 3) {
	    		$newLeadId = substr('000'.$newId, -3);
	    	}

	    	$newLead->lead_id = $clientData['short_name'].$vehileSource.$newLeadId;
	    	$newLead->save();
	    	/*** Lead Id Creation End Here ***/

	    	$data["status"] = "success";
	    	$data["lead"] = $newLead->first();

	    	return $this->setStatusCode(200)->respond($data);
	    }
	}
  
}
