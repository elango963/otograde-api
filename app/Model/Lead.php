<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model {

	protected $fillable = ['id', 'lead_id', 'client_id', 'inspection_type', 'vehicle_id', 'registration_status', 'registration_number', 'loan_agreement_number', 'model_number', 'engine_number', 'chassis_number', 'number_of_owners', 'mfg_date', 'reg_date', 'lead_status_id', 'customer_id', 'executive_id', 'created_at', 'updated_at'];
	
    public $rules = [
	    	'clientName' => 'required',
	    	'clientState' => 'required',
	    	'clientCity' => 'required',
	    	'inspectionType' => 'required|in:retail,repo,c2c',
	    	'vehicleCategory' => 'required',
	    	'registrationNumber' => 'required',
	    	'loanAgreementNumber' => 'required',
	    	'modelNumber' => 'required',
	    	'engineNumber' => 'required',
	    	'chassisNumber' => 'required',
	    	'numberOfOwners' => 'required',
	    	'registrationStatus' => 'required',
	    	'mfgDate' => 'required',
	    	'regDate' => 'required',
	    	'customerName' => 'required',
	    	'customerMobileNumber' => 'required',
	    	'customerAddress1' => 'required',
	    	'customerAddress2' => 'required',
	    	'customerCity' => 'required',
	    	'customerState' => 'required',
	    	'customerZipcode' => 'required',
	    	'executiveName' => 'required',
	    	'executiveNumber' => 'required',
	   	];
}