<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Repository\UserManagement\UserManagementInterface;
class UserController extends BaseController
{

    public $repositoryObj;

    public function __construct(UserManagementInterface $userObj)
    {
        $this->repositoryObj = $userObj;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->repositoryObj->index($request);
        if (!$response["success"]) {
            return $this->sendError('The Record Could not found.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->repositoryObj->store($request);
        if (!$response["success"]) {
            return $this->sendError('The Record Could not Saved.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->repositoryObj->show($id);
        if (!$response["success"]) {
            return $this->sendError('The Record Could not found.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
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
        $response = $this->repositoryObj->update($id, $request);
        if (!$response["success"]) {
            return $this->sendError('The Record Could not be updated.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }
    public function deactivateprofile($id,Request $request)
    {
        
        $response = $this->repositoryObj->deactivateprofile($id, $request);
        if (!$response["success"]) {
            return $this->sendError('The Record Could not be updated.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->repositoryObj->destroy($id);
        if (!$response["success"]) {
            return $this->sendError('The Record Could not be deleted.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }

    public function assignPermissionToRole($role, $permission)
    {
        $response = $this->repositoryObj->assignPermissionToRole($role, $permission);
        if (!$response["success"]) {
            return $this->sendError('permission Could not be assigned to role.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }



    public function removePermissionFromRole($role, $permission)
    {
        $response = $this->repositoryObj->removePermissionFromRole($role, $permission);
        if (!$response["success"]) {
            return $this->sendError('permission Could not be removed.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }



    public function changePassword($id, Request $request)
    {
        $response = $this->repositoryObj->changePassword($id, $request);
        if (!$response["success"]) {
            return $this->sendError('password could not be changed.', ['error' => $response["message"]], $response["code"] );
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }

    public function viewAssignPermissionToRole()
    {
        $response = $this->repositoryObj->viewAssignPermissionToRole();
        // if (!$response["success"]) {
        //     return $this->sendError('permission Could not be assigned to role.', ['error' => $response["message"]]);
        // }
        return $this->sendResponse($response["data"], $response["message"]);
    }

    public function sendresetPasswordLink(Request $request){
        $response = $this->repositoryObj->resetPassword($request);
        if(!$response["success"]){
            return $this->sendError('Unable to Reset Password. Please check your credientials and try again!',['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }

    public function resetPassword(Request $request){
        $response = $this->repositoryObj->resetPassword($request);
        if(!$response["success"]){
            return $this->sendError('Unable to reset password.',['error' => $response["message"]]);
        }
        return $this->sendResponse($response["data"], $response["message"]);
    }

    public function getSignedInUser(Request $request){
        $response = $this->repositoryObj->getSignedInUser($request);
        if(! $response["success"]){
            return $this->sendError('Unable to verify user.', ['error' => $response["message"]]);
        }
        return $this->sendResponse($response, 'User Found Successfully');
    }

}
