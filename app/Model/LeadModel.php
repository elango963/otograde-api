<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LeadModel extends Model {

    protected $table = 'lead';

    public $rules = [
	    	'client_name' => 'required',
	    	'client_state' => 'required',
	    	'client_city' => 'required',
	    	'vehicleCategory' => 'required',
	    	'registrationType' => 'required',
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