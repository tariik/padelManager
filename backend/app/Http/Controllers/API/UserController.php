<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends BaseController 
{

/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        
        if ($validator->fails()) { 
            //return response()->json(['error'=>$validator->errors()], 401);
            return $this->sendError($validator->errors(), 'register eroor.');            
        }
        
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;

        $data = array(
            'results' => $success
        );

        return $this->sendResponse($data, 'register successfully.');
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        $data = array(
            'results' => $user
        );

        return $this->sendResponse($data, 'successfully.');
    } 
}