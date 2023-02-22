<?php

namespace App\Repositories\Eloquent;

use App\Entities\Account;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Validators\AccountValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
{

    public function model()
    {
        return User::class;
    }
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
