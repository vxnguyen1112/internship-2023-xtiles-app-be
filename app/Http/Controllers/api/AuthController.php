<?php

namespace App\Http\Controllers\api;

use App\Helpers\CommonResponse;
use App\Helpers\HttpCode;
use App\Helpers\ResponseHelper;
use App\Helpers\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Services\AccountService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $accountService;
    public function __construct(AccountService $accountService ) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->accountService=$accountService;
    }
    public function register(StoreRegisterRequest $request) {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $result = $this->accountService->store($input);
        return  ResponseHelper::send($result,statusCode:HttpCode::CREATED);
    }
    public function login(LoginRequest $request){
        $result=$this->accountService->login($request->all());
        if($result['status']==HttpCode::CREATED )
        {
            return  ResponseHelper::send($result["data"],statusCode:HttpCode::CREATED);
        }else {
            return ResponseHelper::send([], Status::NG, HttpCode::BAD_REQUEST, $result["data"]);
        }
    }
}
