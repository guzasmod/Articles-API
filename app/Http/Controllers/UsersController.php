<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Validator;

//use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function __construct()
    {
    //$this->middleware('auth.role:admin', ['only' => ['blockUser']]);
   // $this->middleware('auth.role:user', ['only' => ['profile']]);
    $this->middleware('auth.role:manager', ['only' => ['deleteUser', 'store', 'show', 'update']]);
    }

    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(4);

        //return response()->json($users, 201);
        return UserResource::collection($users);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return response()->json(["message" => "User not found!"], 404);
        }

        if(auth()->user()->role == "manager"){
            $user->delete();
            return response()->json(["message" => "Vartotojas ištrintas!"], 200);
        } else {
            return response()->json(["message" => "You don't have permission to delete the user"], 404);
        }

    }

    public function checkToken()
    {
        return response()->json(['success'=>true], 200);
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
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //$user = User::create($request->all());

        $user = User::create(array_merge(
            $validator->validated(),
                ['password' => bcrypt($request->password)],
                ['role' => $request->role],
                ));

        //return response()->json($straipsnis, 201);
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return response()->json(["message" => "User not found!"], 404);
        }

        return new UserResource($user);
        //return response()->json($user, 200);
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
        //$user = auth('api')->user();
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email, '.$user->id,
            'password' => 'sometimes|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        if(is_null($user)){
            return response()->json(["message" => "User not found!"], 404);
        }

        if(auth()->user()->role == "manager") {
          //  $user->update($request->all());
            $user->update(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)],
                ['role' => $request->role],
            ));

            return response()->json($user, 200);
        } else {
            return response()->json(["message" => "You don't have permission to update the user"], 404);
        }
    }

            /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function testUpdate(Request $request, $id)
    {
        //$user = auth('api')->user();
        $user = User::find($id);

        if(is_null($user)){
            return response()->json(["message" => "User not found!"], 404);
        }

            $user->update($request->all());

            return response()->json($user, 200);
    }

}
