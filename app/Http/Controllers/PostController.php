<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Straipsnis;

use App\Puslapis;
use App\Kategorija;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;

class PostController extends Controller
{
    public function postai(){
        return response()->json(Straipsnis::get(), 200);
    }

    public function postByID($id){
        //su validacija:

        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        return response()->json($straipsnis, 200);
    }

    public function postSave(Request $request){
        $rules = [
            'pavadinimas' => 'required|min:3',
            'turinys' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $straipsnis = Straipsnis::create($request->all());
        return response()->json($straipsnis, 201);
    }

    public function postUpdate(Request $request, $id){
        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        $straipsnis->update($request->all());
        return response()->json($straipsnis, 200);
    }

    public function postDelete(Request $request, $id){
        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        $straipsnis->delete();
        return response()->json(null, 204);
    }
}
