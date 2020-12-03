<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Response; 
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\User2Service;

use DB;

Class User2Controller extends Controller {
    use ApiResponser;

    /**
     * The service to consume the User2 Microservice
     * @var User2Service
     */
    public $user2Service;
    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct(User2Service $user2Service){
        $this->user2Service =$user2Service;
    }

    private $request;


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
        return $this->successResponse($this->user2Service->obtainUsers2()); 
    }

    //ADD new record in the database
    public function add(Request $request){
        return $this->successResponse($this->user2Service->createUser2($request->all(),Response::HTTP_CREATED));
    }

    //SHOW record by using ID
    public function show($id){
        return $this->successResponse($this->user2Service->obtainUser2($id));
    }

    //UPDATE the record
    public function update(Request $request, $id){
        return $this->successResponse($this->user2Service->editUser2($request->all(),$id));
    }

    //DELETE the record
    public function delete($id){
        return $this->successResponse($this->user2Service->deleteUser2($id));        
    }
}