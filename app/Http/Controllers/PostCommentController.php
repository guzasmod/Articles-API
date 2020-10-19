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

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $straipsnis = Straipsnis::find($id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Post not found!"], 404);
        }

        return response()->json($straipsnis->comments, 200);
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
    public function store(Request $request, $post_id)
    {
            $straipsnis = Straipsnis::find($post_id);
    
            if(is_null($straipsnis)){
                return response()->json(["message" => "Post not found!"], 404);
            }


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
    public function show($post_id, $id)
    {
        $straipsnis = Straipsnis::find($post_id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Post not found!"], 404);
        }

        $komentaras = Komentaras::find($id);

        if(is_null($komentaras)){
            return response()->json(["message" => "Comment not found!"], 404);
        }


       if($komentaras->fk_Straipsnis_id == $post_id)
       {
       return response()->json($komentaras, 200);
       }
       else {
        return response()->json(["message" => "Comment doesn't belong to this post!"], 404);
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
    public function update(Request $request, $post_id, $id)
    {
        $straipsnis = Straipsnis::find($post_id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        $komentaras = Komentaras::find($id);

        if(is_null($komentaras)){
            return response()->json(["message" => "Comment not found!"], 404);
        }


       if($komentaras->fk_Straipsnis_id == $post_id)
       {
            $komentaras->update($request->all());
            return response()->json($komentaras, 200);
       }
       else {
            return response()->json(["message" => "You don't have permission to update this comment!"], 404);
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $id)
    {
        $straipsnis = Straipsnis::find($post_id);

        if(is_null($straipsnis)){
            return response()->json(["message" => "Record not found!"], 404);
        }
       
        $komentaras = Komentaras::find($id);

        if(is_null($komentaras)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        if($komentaras->fk_Straipsnis_id == $post_id)
        {
             $komentaras->delete();
             return response()->json($komentaras, 200);
        }
        else {
             return response()->json(["message" => "You don't have permission to delete this post!"], 404);
        }
    }
}
