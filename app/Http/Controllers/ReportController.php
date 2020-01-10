<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\{Lead, ReportImage, ReportGeneralInput, ReportReviewsInput, ReportTestDriveInput, ReportParivahanDetailInput};

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function uploadImageService(Request $request)
    {
        $labelFormat = [
            "front_img" => "Front Image",
            "right_side_img" => "Right Side",
            "rear_img" => "Rear Image",
            "left_side_img" => "Left Side",
            "dashboard_img" => "Dashboard",
            "seats_img" => "Seats",
            "odo_meter_img" => "ODO Meter",
            "engine_room_img" => "Engine Room",
            "engine_reg_plate_img" => "Engine Reg.Plate",
            "chassis_imp_img" => "Chassis IMP",
            "chassis_number_img" => "Chassis Number",
            "rc_book_front_img" => "RC Book Front",
            "rc_book_back_img" => "RC Book Back",
            "tyre_img_1" => "TYRE 1",
            "tyre_img_2" => "TYRE 2",
            "tyre_img_3" => "TYRE 3",
            "tyre_img_4" => "TYRE 4",
            "selfie_img" => "Selfie Image",
            "damage_img_1" => "Damage 1 (Optional)",
            "damage_img_2" => "Damage 2 (Optional)",
            "damage_img_3" => "Damage 3 (Optional)",
            "damage_img_4" => "Damage 4 (Optional)",
        ];

        $this->returnGeneralResponse();
        $reportImage = app()->make(ReportImage::class);
        $validationResult = $this->validator($request, $reportImage->rules);
        if ($validationResult !== false) {
            $errorList = $validationResult->original;
            $this->response["data"] = [
                "errorMessage" => $errorList["errors"]->getMessages()
            ];

            return $this->setStatusCode(422)->respond($this->response);
        } else {
            $file = $request->file('file');
            $lead = $request->get('lead');
            $filenamestr = $request["originalFileName"];
            $filePath = $request->file('file_path');
            $ext = substr($filenamestr, strrpos($filenamestr, '.')+1);
            $filename = $labelFormat[$request['slug']].'.'.$ext;
            $filePath = sprintf('%s/uploads/%s', base_path('public'), $lead->report_id);
            $file->move($filePath, $filename);

            /*** Table storage function start here ***/
            $clientData['lead_id'] = $request['leadId'];
            $clientData['report_id'] = $lead->report_id;
            $clientData['slug'] = $request['slug'];
            $clientData['label'] = $labelFormat[$request['slug']];
            $clientData['file_name'] = $request['originalFileName'];
            $clientData['file_path'] = sprintf('uploads/%s/%s', $lead->report_id, $filename);
            $reportImage->updateOrCreate(["lead_id" => $lead->id, "slug" => $request['slug']], $clientData);
            /*** Client Details Insert End Here ***/
            $this->response["status"] = "success";
            $this->response["isUploaded"] = true;
        }
        return $this->setStatusCode(200)->respond($this->response);
    }

    public function returnGeneralResponse() {
        $this->response = [
            "status" => "failed",
            "isUploaded" => false,
            "data" =>[]
        ];

        return $this;
    }

    public function getReportTabDetails(Request $request) {
        $this->response = [
            "status" => "success",
            "data" => []
        ];
        $this->lead = $request->get("lead");
        if (empty($request->get("tabname")) === false) {
            $this->response["tabname"] = str_replace(array("valuator-report-form-", "-tab-details"), array("", ""), $request->get("tabname"));
            $this->tabname = str_replace("-", "_", $this->response["tabname"]);
            
            // $this->tabname = "test_drive";
            $tablelist = [
                "upload" => "report_images",
                "general_input" => "report_general_inputs",
                "parivahan_detail" => "report_parivahan_detail_inputs",
                "reviews" => "report_reviews_inputs",
                "test_drive" => "report_test_drive_inputs",
            ];
            $this->getQuestionAndDefaultAnswer();
            if ($this->tabname === "upload") {
                $this->tableRepo = app()->make(ReportImage::class);
                $this->response["data"]["answers"] = $this->tableRepo->reportImage($request->get("leadId"))->keyBy('slug');
            } if ($this->tabname === "general_input") {
                $this->tableRepo = app()->make(ReportGeneralInput::class);
                $this->response["data"]["answers"] = $this->tableRepo->generalInput($request->get("leadId"));
            } elseif ($this->tabname === "parivahan_detail") {
                $this->tableRepo = app()->make(ReportParivahanDetailInput::class);
                $this->response["data"]["answers"] = $this->tableRepo->parivahanDetail($request->get("leadId"));
            } elseif ($this->tabname === "reviews") {
                $this->tableRepo = app()->make(ReportReviewsInput::class);
                $this->response["data"]["answers"] = $this->tableRepo->review($request->get("leadId"));
            } elseif ($this->tabname === "test_drive") {
                $this->tableRepo = app()->make(ReportTestDriveInput::class);
                $this->response["data"]["answers"] = $this->tableRepo->testDrive($request->get("leadId"));
            }
            if ($this->tabname !== "upload") {
                $this->saveDefaultAnswer();
                $this->tableRepo = app()->make(ReportImage::class);
                $this->response["data"]["reportimages"] = $this->tableRepo->reportImage($request->get("leadId"))->keyBy('slug');
            }
            
        }
        
        return $this->setStatusCode(200)->respond($this->response);
    }

    public function getQuestionAndDefaultAnswer()
    {
        $valuatorForm = file_get_contents(base_path('config/') . "valuator-form-questions.json");
        $jsonList = json_decode($valuatorForm, true);
        $this->response["data"]["questions"] = [];
        $this->defaultAnswerData = [];
        if (empty($jsonList[$this->tabname]) === false) {
            $this->response["data"]["questions"] = $jsonList[$this->tabname];
            foreach ($jsonList[$this->tabname] as $key => $value) {
                if (empty($value["options"]) === false) {
                    foreach ($value["options"] as $optionKey => $optionValue) {
                        if (empty($optionValue["default"]) === false) {
                            $this->defaultAnswerData[$key] = $optionKey;
                            break;
                        }
                    }
                }
            }
        }

        return $this;
    }

    public function saveDefaultAnswer()
    {
        $saveData = array_merge($this->defaultAnswerData, empty($this->response["data"]["answers"]) === false ? $this->response["data"]["answers"]->toArray() : []);
        $removeElem = ["id", "created_at", "updated_at"];
        $saveData = array_diff_key($saveData, array_flip($removeElem));
        $saveData["lead_id"] = $this->lead->id;
        $saveData["report_id"] = $this->lead->report_id;
        $this->tableRepo->updateOrCreate(["lead_id" =>$this->lead->id, "report_id" => $this->lead->report_id], $saveData);
        $this->response["data"]["answers"] = $this->tableRepo->where('lead_id', $this->lead->id)->first()->toArray();
        $removeElem = ["id", "created_at", "updated_at"];
        $this->response["data"]["answers"] = array_diff_key($this->response["data"]["answers"], array_flip($removeElem));
        return $this;
    }

    public function previewPageDataService(Request $request)
    {
        $this->response = [
            "status" => "success",
            "data" => []
        ];
        $lead = $request->get("lead");
        
        $reportimage = app()->make(ReportImage::class);
        $reportimages = $reportimage->reportImage($lead->id)->keyBy('slug');
        $reportimg = [];
        if ($reportimages->count() > 0) {
            $reportimg["reportimages"] = $reportimages->toArray();
        }

        $generalInput = app()->make(ReportGeneralInput::class);
        $generalInputs = $generalInput->generalInput($lead->id);
        $generalInput = [];
        if (empty($generalInputs) === false) {
            $generalInput = $generalInputs->toArray();
        }

        $parivahanDetail = app()->make(ReportParivahanDetailInput::class);
        $parivahanDetails = $parivahanDetail->parivahanDetail($lead->id);
        $parivahanDetail = [];
        if (empty($parivahanDetails) === false) {
            $parivahanDetail = $parivahanDetails->toArray();
        }
        
        $review = app()->make(ReportReviewsInput::class);
        $reviews = $review->review($lead->id);
        $review = [];
        if (empty($reviews) === false) {
            $review = $reviews->toArray();
        }

        $testDrive = app()->make(ReportTestDriveInput::class);
        $testDrives = $testDrive->testDrive($lead->id);
        $testDrive = [];
        if (empty($testDrives) === false) {
            $testDrive = $testDrives->toArray();
        }
        $data = array_merge($lead->toArray(), $testDrive, $review, $parivahanDetail, $generalInput, $reportimg);
        $removeElem = ["id", "client_id",  "lead_status_id",  "vehicle_category_id",  "customer_detail_id",  "executive_detail_id", "updated_at"];
        $data = array_diff_key($data, array_flip($removeElem));

        $data["clients"]["name"] = $lead->clients->name;
        $data["clients"]["short_name"] = $lead->clients->short_name;
        $data["clients"]["city"] = $lead->clients->city;
        $data["clients"]["state"] = $lead->clients->state;
        $data["clients"]["zipcode"] = $lead->clients->zipcode;

        $data["vehicle_category"]["category"] = $lead->clients->category;
        $data["vehicle_category"]["description"] = $lead->clients->description;

        $data["lead_status"]["description"] = $lead->LeadStatus->description;
        $data["customer_detail"] = $lead->LeadCustomerDetail->select('name', 'mobile', 'address1', 'address2', 'city', 'state', 'zipcode')->first()->toArray();
        $data["executive_detail"] = $lead->ExecutiveDetail->select('name', 'mobile')->first()->toArray();
        // $this->getValueBasedKey();
        return $this->setStatusCode(200)->respond(["status" => "success", "data" => $data]);
    }

}