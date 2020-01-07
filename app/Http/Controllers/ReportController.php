<?php

namespace App\Http\Controllers;

use DB;
use Storage;
use Validator;
use App\Model\Lead;
use Illuminate\Http\Request;
use App\Model\ReportImage;
use App\Model\ReportGeneralInput;
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
            $filename = $request["originalFileName"];
            $filePath = sprintf('%s/uploads/%s', base_path('public'), $request->get("reportId"));
            $file->move($filePath, $filename);

            /*** Table storage function start here ***/
            $clientData['lead_id'] = $request['leadId'];
            $clientData['report_id'] = $lead->report_id;
            $clientData['slug'] = $request['slug'];
            $clientData['label'] = $labelFormat[$request['slug']];
            $clientData['file_name'] = $request['originalFileName'];
            // print_r($clientData);exit;
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
        $response = [
            "status" => "success",
            "data" => []
        ];
        if (empty($request->get("tabname")) === false) {
            $tabname = str_replace(array("-", "valuator_report_form_", "_tab_details"), array("_", "", ""), $request->get("tabname"));
            $tablelist = [
                "upload" => "report_images",
                "general_input" => "report_general_inputs",
                "parivahan_detail" => "report_parivahan_detail_inputs",
                "reviews" => "report_reviews_inputs",
                "test_drive" => "report_test_drive_inputs",
            ];
            if ($tabname === "general_input") {
                $generalInput = app()->make(ReportGeneralInput::class);
                $data = $generalInput->generalInput($request->get("leadId"));
            } elseif ($tabname === "parivahan_detail") {
                $generalInput = app()->make(ReportGeneralInput::class);
                $data = $generalInput->generalInput($request->get("leadId"));
            } elseif ($tabname === "reviews") {
                $generalInput = app()->make(ReportGeneralInput::class);
                $data = $generalInput->generalInput($request->get("leadId"));
            } elseif ($tabname === "test_drive") {
                $generalInput = app()->make(ReportGeneralInput::class);
                $data = $generalInput->generalInput($request->get("leadId"));
            }
            $response["data"] = empty($data) === false ? $data : [];
        }
        
        return $this->setStatusCode(200)->respond($response);
    }
}