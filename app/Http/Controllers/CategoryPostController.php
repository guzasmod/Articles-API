<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Straipsnis;
use App\Komentaras;
use App\Kategorija;
use Validator;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Comment as CommentResource;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $kategorija = Kategorija::find($id);

        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }

        return response()->json($kategorija->straipsniai, 200);
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
    public function store(Request $request, $category_id)
    {
        $kategorija = Kategorija::find($category_id);
    
        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }


    $rules = [
        'pavadinimas' => 'required|min:3'
    ];

    $validator = Validator::make($request->all(), $rules);

    if($validator->fails()){
        return response()->json($validator->errors(), 400);
    }

    $straipsnis = Straipsnis::create($request->all());
    //return response()->json($komentaras, 201);
    return new PostResource($straipsnis);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id, $id)
    {
        $kategorija = Kategorija::find($category_id);

        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }

        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Post not found!"], 404);
        }


       if($straipsnis->fk_Straipsnio_kategorija_id == $category_id)
       {
       return response()->json($straipsnis, 200);
       }
       else {
        return response()->json(["message" => "Post doesn't belong to this category!"], 404);
        }
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
    public function update(Request $request, $category_id, $id)
    {
        $kategorija = Kategorija::find($category_id);

        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }

        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Post not found!"], 404);
        }

       if($straipsnis->fk_Straipsnio_kategorija_id == $category_id)
       {
            $straipsnis->update($request->all());
            return response()->json($straipsnis, 200);
       }
       else {
            return response()->json(["message" => "You don't have permission to update this post!"], 404);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id, $id)
    {
        $kategorija = Kategorija::find($category_id);

        if(is_null($kategorija)){
            return response()->json(["message" => "Category not found!"], 404);
        }
       
        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Article not found!"], 404);
        }

        if($straipsnis->fk_Straipsnio_kategorija_id == $category_id)
        {
             $straipsnis->delete();
             return response()->json($straipsnis, 200);
        }
        else {
             return response()->json(["message" => "You don't have permission to delete this post!"], 404);
        }
    }
}
