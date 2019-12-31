<?php

namespace App\Http\Controllers;

use DB;
use Storage;
use Validator;
use App\Model\Lead;
use Illuminate\Http\Request;
use App\Model\ReportImage;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function imageStoreService(Request $request)
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
                "errorMessage" => implode(",", array_column($errorList["data"]["errors"], "message"))
            ];

            return $this->setStatusCode(422)->respond($this->response);
        } else {
            $file = $request->file('file');
            $filename = $request["originalFileName"];
            $filePath = sprintf('%s/uploads/%s', base_path('public'), $request->get("reportId"));
            $file->move($filePath, $filename);
            $this->response["status"] = "success";
            $this->response["isUploaded"] = true;

            /*** Table storage function start here ***/
            $imageUpload['lead_id'] = $request['leadId'];
            $clientData['slug'] = $request['slug'];
            $clientData['label'] = $labelFormat[$request['slug']];
            $clientData['file_name'] = $request['originalFileName'];
            
            $reportImage->create($clientData);
            /*** Client Details Insert End Here ***/

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
}