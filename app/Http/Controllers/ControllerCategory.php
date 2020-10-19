<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Straipsnis;
use App\Komentaras;
use App\Kategorija;
use Validator;
use App\Http\Resources\Category as CategoryResource;

class ControllerCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategorijos = Kategorija::paginate(5);

        //return collection of articles as a resource
        return CategoryResource::collection($kategorijos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'pavadinimas' => 'required|min:3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $kategorija = Kategorija::create($request->all());
        //return response()->json($kategorija, 201);
        return new CategoryResource($kategorija);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //su validacija:

        $kategorija = Kategorija::find($id);

        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }

        return new CategoryResource($kategorija);
        //return response()->json($kategorija, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategorija = Kategorija::find($id);

        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }

        $kategorija->update($request->all());
        return response()->json($kategorija, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategorija = Kategorija::find($id);

        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }

        $kategorija->delete();
        //return response()->json(null, 204);
        return new CategoryResource($kategorija);
    }
}
