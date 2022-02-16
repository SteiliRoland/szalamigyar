<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Models\Szalamik;
use App\Http\Resources\Szalamik as SzalamikResource;

class SzalamiController extends BaseController
{
    public function index(){
        $szalamik =Szalamik::all();
        return $this->sendResponse(SzalamikResource::collection($szalamik),"Posztok betöltve");
    }

    public function store(Request $request){
        $input =$request->all();
        $validator= Validator::make($input, [
            "termeknev" =>"required",
            "ar" => "required",
            "alapanyag_id" => "required"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());

        }

        $szalamik = Szalamik::create($input);

        return $this->sendResponse(new SzalamikResource($szalamik), "Szalámi hozzáadva");

    }

    public function show($id){
        $szalamik = Szalamik::find($id);
        if(is_null($szalamik)){
            return $this->sendError("Nincs ilyen szalámi");
        }
        return $this->sendResponse(new SzalamikResource($szalamik), "Szalámik betöltve");
    }
    public function update(Request $request, Szalamik $szalamik){
        $input =$request->all();
        $validator =Validator::make($input,[
         
            "termeknev" =>"required",
            "ar" => "required",
            "alapanyag_id" => "required"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());

        }
        $szalamik -> termeknev =$input["termeknev"];
        $szalamik -> ar =$input["ar"];
        $szalamik -> alapanyag_id =$input["alapanyag_id"];
        $szalamik->save();
        return $this->sendResponse(new SzalamikResource($szalamik), "Szalámi modósítva");
    }

    public function destroy($id){
        $szalamik->delete($id);

        return $this->sendResponse([], "Szalámi törölve");
    }
    
    public function search($termeknev){
        $result = Products::where('termeknev', 'LIKE', '%'. $termeknev. '%')->get();
        if(count($result)){
            return Response()->json($result);
        }
        else
        {
            return response()->json(['Result' => 'Nincs talalat'], 404);
        }
    }
    public function materialsearch($alapanyag){
        $result = Material::where('alapanyag', 'LIKE', '%'. $alapanyag. '%')->join('products', 'alapanyagok.id', '=', 'szalamik.alapanyag_id')->get();
        if(count($result)){
            return Response()->json($result);
        }
        else
        {
            return response()->json(['Result' => 'Nincs talalat'], 404);
        }
    }
}
