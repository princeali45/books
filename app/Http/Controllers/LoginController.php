<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Traits\ApiResponser;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{

    use ApiResponser;
    private $request;


    public function __construct(Request $request){
        $this->request = $request;
    }

    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function find(Request $request ){
        $rules = [
        'username' => 'required|max:20',
        'password' => 'required|max:20',
        ];

        
        $this->validate($request,$rules);
        $user = User::where('username', $request->input('username'))
        ->where('password', $request->input('password'))
        ->firstOrFail(); 
        return $this->successResponse($user);
    
    }

}

