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

            /*** Table storage function start here *** /
            $imageUpload['report_id'] = $request['reportId'];
            $clientData['file_name'] = $request['originalFileName'];
            $clientData['slug'] = $request['front_image'];
            
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