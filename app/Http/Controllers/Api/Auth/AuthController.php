<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Komentaras;
use App\Straipsnis;
use App\Puslapis;
use App\Kategorija;

class AuthController extends Controller
{

    public function __construct() {
       // $this->middleware('auth:api', ['except' => ['login', 'register']]);
       // $this->middleware('auth:api', ['except' => ['login', 'register']]);
        //$this->middleware('auth.role', ['except' => ['login', 'register']]);
        $this->middleware('auth.role:manager,admin,user', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //$data = $request->only(['email', 'password']);

        $userID = auth()->user();
        $customClaims = ['scope' => 'admin', 'role' => $userID];
        if (! $token = auth()->attempt($validator->validated())) {
        //if (! $token = auth()->claims($customClaims)->attempt($validator->validated())) {
            //return response()->json(['error' => 'Unauthorized'], 401);
            return response()->json(['error' => 'Wrong email or password'], 401);
        }

        return $this->createNewToken($token);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'success' => true,
        ], 201);
    }

    public function logout() {
        /*try{
            auth()->logout();
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 401);
        }
        */
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function userProfile(){
        $user = auth()->userOrFail();
        //$user = auth()->user();
        $posts = auth()->user()->posts;
        $comments = auth()->user()->comments;

        $post_count = count(Straipsnis::where('user_id', auth()->user()->id)->get());
        $comment_count = count(Komentaras::where('email', auth()->user()->email)->get());

        //return $user;
       // return $posts;

        return response()->json([
            'post_count' => $post_count,
            'comment_count' => $comment_count,
            'user_email' => auth()->user()->email,
            'posts' => $posts,
            'comments' => $comments,
            'user' => auth()->user()
        ], 201);
    }

    public function refresh() {
  /*      try {
            $newToken = auth()->refresh();        
        }catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }
    
        return response()->json(['token' => $newToken]);
*/

        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'user' => auth()->user(),
            'success' => true
        ]);
    }

    public function checkToken()
    {
        return response()->json(['success'=>true], 200);
    }

}
