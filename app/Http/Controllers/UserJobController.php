<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserJob;
use App\Traits\ApiResponser;


class UserJobController extends Controller
{
    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $usersjob = UserJob::all();
        return $this->successResponse($usersjob);
    }

    public function show($id)
    {
        $usersjob = UserJob::findOrFail($id);
        return $this->successResponse($usersjob);
    }

    public function add(Request $request ){
        $rules = [
        'jobid' => 'required|numeric|min:1|not_in:0',
        'jobname' => 'required|max:20',
        ];  
        $this->validate($request,$rules);
        $usersjob = UserJob::create($request->all());
        return $this->successResponse($usersjob, Response::HTTP_CREATED);
    }
}
