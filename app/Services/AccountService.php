<?php

namespace App\Services;
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
}
