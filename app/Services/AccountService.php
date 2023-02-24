<?php

namespace App\Services;
use App\Helpers\HttpCode;
use App\Repositories\AccountRepository;

class AccountService
{
    protected  $accountRepository;

    /**
     * @param $accountRepository
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    public function store($data)
    {
        return $this->accountRepository->create($data);
    }
    public function login($request){
        if (! $token = auth()->attempt($request)) {
            return ['data' => 'Unauthorized',
                'status'=>HttpCode::BAD_REQUEST
            ];
        }

        return $this->createNewToken($token);
    }
    protected function createNewToken($token){
        $results["data"]=[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'account' => auth()->user()
        ];
        $results["status"]=HttpCode::CREATED;
        return $results;
    }
    public function logout() {
        auth()->logout();
        return ['message' => 'User successfully signed out'];
    }
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
}
