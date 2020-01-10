<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\{Lead, ReportImage, ReportGeneralInput, ReportReviewsInput, ReportTestDriveInput, ReportParivahanDetailInput};

use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    public function saveAnswer(Request $request)
    {
        $rules = [
            "form" => "required",
            "leadId" => "required",
            "questionSlug" => "required",
            "answer" => "required",
        ];
        $validationResult = $this->validator($request, $rules);
        if ($validationResult !== false) {
            $errorList = $validationResult->original;
            $response["status"] = "failed";
            $response["data"] = [
                "errorMessage" => $errorList["errors"]->getMessages()
            ];

            return $this->setStatusCode(422)->respond($response);
        } else {
            $lead = $request->get("lead");
            $this->tabname = $request->get("form");
            if ($this->tabname === "general_input") {
                $this->tableRepo = app()->make(ReportGeneralInput::class);
            } elseif ($this->tabname === "parivahan_detail") {
                $this->tableRepo = app()->make(ReportParivahanDetailInput::class);
            } elseif ($this->tabname === "reviews") {
                $this->tableRepo = app()->make(ReportReviewsInput::class);
            } elseif ($this->tabname === "test_drive") {
                $this->tableRepo = app()->make(ReportTestDriveInput::class);
            }

            $response["status"] = "error";
            if (empty($this->tableRepo) === false) {
                $requestData = [];
                $requestData["lead_id"] = $lead->id;
                $requestData["report_id"] = $lead->report_id;
                $requestData[$request["questionSlug"]] = $request["answer"];
                
                $this->tableRepo->updateOrCreate(["lead_id" => $lead->id, "report_id" => $lead->report_id], $requestData);
            }
            $response["status"] = "success";
            $response["data"] = [];
            
            return $this->setStatusCode(200)->respond($response);
        }
    }

    public function saveAllAnswers(Request $request)
    {
        $rules = [
            "form_type" => "required",
            "leadId" => "required"
        ];
        $validationResult = $this->validator($request, $rules);
        if ($validationResult !== false) {
            $errorList = $validationResult->original;
            $response["status"] = "failed";
            $response["data"] = [
                "errorMessage" => $errorList["errors"]->getMessages()
            ];

            return $this->setStatusCode(422)->respond($response);
        } else {
            $lead = $request->get("lead");
            $this->tabname = $request->get("form_type");
            if ($this->tabname === "general_input") {
                $this->tableRepo = app()->make(ReportGeneralInput::class);
            } elseif ($this->tabname === "parivahan_detail") {
                $this->tableRepo = app()->make(ReportParivahanDetailInput::class);
            } elseif ($this->tabname === "reviews") {
                $this->tableRepo = app()->make(ReportReviewsInput::class);
            } elseif ($this->tabname === "test_drive") {
                $this->tableRepo = app()->make(ReportTestDriveInput::class);
            }

            $response["status"] = "error";
            if (empty($this->tableRepo) === false) {
                $requestData = $request->all();
                $requestData["lead_id"] = $lead->id;
                $requestData["report_id"] = $lead->report_id;
                unset($requestData["form_type"]);
                unset($requestData["leadId"]);
                $this->tableRepo->updateOrCreate(["lead_id" => $lead->id, "report_id" => $lead->report_id], $requestData);
            }
            $response["status"] = "success";
            $response["data"] = [];
            
            return $this->setStatusCode(200)->respond($response);
        }
    }

}