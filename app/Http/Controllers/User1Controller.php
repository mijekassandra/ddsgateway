<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Response; 
//use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\User1Service;

use DB;

Class User1Controller extends Controller {
    //use ApiResponser;

    /**
     * The service to consume the User1 Microservice
     * @var User1Service
     */
    public $user1Service;
    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct(User1Service $user1Service){
        $this->user1Service =$user1Service;
    }

    private $request;

    /********************************************************* */

    public function successResponse($data, $code = Response::HTTP_OK){
        return response($data, $code)->header('Content-Type','application/json');    
    }

    public function errorResponse($message, $code){
        return response()->json(['error' => $message, 'code' => $code],$code);
    }

    public function errorMessage($message, $code){
        return response($message, $code)->header('Content-Type','application/json');
    }

    /********************************************************* */

    // public function __construct(Request $request){
    //     $this->request = $request;
    // }
    

    //GET the data from the database
    // public function getUsers(){
    //     $users = DB::connection('mysql')
    //     ->select("Select * from tbluser");

    //     return response()->json($users,200);
    // }

    //SHOW ALL the data from the database
    public function index(){
        return $this->successResponse($this->user1Service->obtainUsers1()); 
    }

    //ADD new record in the database
    public function add(Request $request){
       return $this->successResponse($this->user1Service->createUser1($request->all(),Response::HTTP_CREATED));
    }

    //SHOW record by using ID
    public function show($id){
        return $this->successResponse($this->user1Service->obtainUser1($id));
    }

    //UPDATE the record
    public function update(Request $request, $id){
        return $this->successResponse($this->user1Service->editUser1($request->all(),$id));
    }

    //DELETE the record
    public function delete($id){
        return $this->successResponse($this->user1Service->deleteUser1($id));
    }
}