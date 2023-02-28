<?php
namespace App\Http\Controllers\API;
use App\Repository\UserManagement\UserManagementInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{
    public $userObj;
    public function __construct(UserManagementInterface $userObj)
    {
        $this->userObj = $userObj;
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username'=>'required|unique:users,username',
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            $response = [
                'success' => false,
                'error code' =>'401',
                'error_message' => $error,
                // 'error code' =>'401',
            ];
            return $response;
            // return $this->sendError('Validation Error.', $validator->errors());
        }

        $response = $this->userObj->store($request);
        $user = $response["data"];
        $success['accessToken'] =  $user->createToken('MyApp')->plainTextToken;
        $success['id'] =  $user->id;
        $success['username'] = $user->username;
        $success['name'] =   $user->fname . " " . $user->lname;
        $success['email'] = $user->email;
        $success['image'] = $user->image;
        if (!$response["success"]) {
            return $this->sendError('User not Registered.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($success, $response["message"]);

    }



    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            //dd($user);
      
            if($request->exists("role") && !($user->getRoleNames()->contains($request->role))){
                return [
                    "success"=> false,
                    "message" => "Access denied",
                    ];
            }

            $getAbilitiesName = $user->getAbilitiesName();
            $token = $user->createToken('MyApp',$getAbilitiesName)->plainTextToken;
            $success['accessToken'] =  $token;
            $success['refreshToken'] =  $token;
            $success['id'] = $user->id;
            $success['username'] = $user->username;
            $success['fullName'] = $user->getFullName();
            $success['email'] = $user->email;
            $success['avatar'] = $user->image ;
            $success['role'] = $user->roles[0];
            $permissions = $user->getAbility();
            $success['ability'] = $permissions;
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return response()->json(['error message'=>'Unauthorised','error_code'=>'404','success'=>false]);

            // return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
