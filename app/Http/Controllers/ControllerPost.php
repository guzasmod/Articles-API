<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Straipsnis;
use App\Komentaras;
use App\Kategorija;
use Validator;
use App\Http\Resources\Post as PostResource;

class ControllerPost extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //before
        //return response()->json(Straipsnis::get(), 200);

        
        $straipsniai = Straipsnis::orderBy('sukurimo_data', 'desc')->paginate(5);

        //return collection of articles as a resource
        return PostResource::collection($straipsniai);
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
            'pavadinimas' => 'required|min:3',
            'turinys' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $straipsnis = Straipsnis::create($request->all());
        //return response()->json($straipsnis, 201);
        return new PostResource($straipsnis);
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

        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Post not found!"], 404);
        }

        return new PostResource($straipsnis);
        //return response()->json($straipsnis, 200);
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
        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        $straipsnis->update($request->all());
        return response()->json($straipsnis, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        $straipsnis->delete();
        //return response()->json($straipsnis, 204);
        return new PostResource($straipsnis);
    }
}
