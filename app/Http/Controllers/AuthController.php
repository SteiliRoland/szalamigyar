<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseControllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

class AuthController extends BaseController
{
    public function signup(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirmed_password" => "required|same:password"
        ]);
        if($validator->fails()){
            return $this->sendError("Validálási hiba", $validator->errors());
        }
        $input=$request->all();
        $input["password"] =bcrypt($input["password"]);
        $user =User::create($input);
        $succes[ "name"]=$user->name;

        return $this->sendResponse($succes, "Sikeres regisztráció");
    }
    public function signin(Request $request){
        if(Auth::attempt(["email" =>$request->email, "password" =>$request->password])){
            $authUser=Auth::user();
            $succes["token"] = $authUser->createToken("myapitoken")->plainTextToken;
            $succes["name"]= $authUser->name;

            return $this->sendResponse($succes, "Sikeres Bejelentkezés");
        }
        else{
            return $this->sendError("Unauthoristed", ["error" => "Hibás adatok"]);

        }
    }
    public function logout (Request $request){
        auth("sanctum")->user()->currentAccessToken()->delete();
        
        return response()->json("sikeres kijelentkezés");
    }
}
