<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Straipsnis;
use App\Komentaras;
use App\Kategorija;
use Validator;
use App\Http\Resources\Comment as CommentResource;

class ControllerComment extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth.role:admin', ['only' => ['blockUser']]);
       // $this->middleware('auth.role:manager', ['only' => ['destory']]);
        $this->middleware('auth.role:manager,user,admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return response()->json(Straipsnis::get(), 200);

        $komentarai = Komentaras::orderBy('sukurimo_data', 'desc')->paginate(5);

        //return collection of articles as a resource
        return CommentResource::collection($komentarai);
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
            'turinys' => 'required|min:3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $komentaras = Komentaras::create($request->all());
        //return response()->json($komentaras, 201);
        return new CommentResource($komentaras);
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

        $komentaras = Komentaras::find($id);

        if(is_null($komentaras)){
            return response()->json(["message" => "Comment not found!"], 404);
        }

        return new CommentResource($komentaras);
        //return response()->json($komentaras, 200);
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
        $komentaras = Komentaras::find($id);

        if(is_null($komentaras)){
            return response()->json(["message" => "Comment not found!"], 404);
        }

        if(auth()->user()->email == Komentaras::find($id)->email || auth()->user()->role == "manager" || auth()->user()->role == "admin"){
            $komentaras->update($request->all());
            return new CommentResource($komentaras);
        } else {
            return response()->json(["message" => "You don't have permission to update this comment"], 404);
        }

       // $komentaras->update($request->all());
       // return response()->json($komentaras, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komentaras = Komentaras::find($id);

        if(is_null($komentaras)){
            return response()->json(["message" => "Comment not found!"], 404);
        }

        if(auth()->user()->email == Komentaras::find($id)->email || auth()->user()->role == "manager" || auth()->user()->role == "admin"){
            $komentaras->delete();
            return new CommentResource($komentaras);
        } else {
            return response()->json(["message" => "You don't have permission to delete this comment"], 404);
        }

       // $komentaras->delete();
       // return new CommentResource($komentaras);
    }
}
