<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
    public function sendResponse($result, $message){
        $response=[
            "succces"=> true,
            "data"=>$result,
            "message"=>$message,

        ];
        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages=[], $code=404){
        $response =[
            "succes"=>false,
            "message"=>$error
        ];
        if(!empty($errorMessages)){
            $response["data"]=$errorMessages;

        }
        return response()->json($response,$code);
    }
}
