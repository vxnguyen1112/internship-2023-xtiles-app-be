<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Account;
    use App\Repositories\AccountRepository;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
    {

        public function model()
        {
            return Account::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

    }
