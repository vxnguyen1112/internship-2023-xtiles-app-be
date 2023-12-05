<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Repositories\AccountRepository;
    use Illuminate\Support\Facades\Log;
    use PhpParser\Node\Stmt\Return_;

    class AccountService
    {
        protected $accountRepository;

        /**
         * @param $accountRepository
         */
        public function __construct(AccountRepository $accountRepository)
        {
            $this->accountRepository = $accountRepository;
        }

        public function register($data)
        {
            $account = $this->accountRepository->findWhere(['email' => $data['email']])->first();
            if (!is_null($account) && $account['is_verified']) {
                return HttpCode::BAD_REQUEST;
            }
            if (!is_null($account)) {
                return $this->accountRepository->update([
                    'password' => $data['password'],
                    'is_verified' => true
                ], $account['id']);
            }
            return $this->accountRepository->create($data);
        }

        public function login($request)
        {
            if (!$token = auth()->attempt($request)) {
                return [
                    'data' => 'Unauthorized',
                    'status' => HttpCode::BAD_REQUEST
                ];
            }
            return $this->createNewToken($token);
        }

        protected function createNewToken($token)
        {
            $results["data"] = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'account' => auth()->user()
            ];
            $results["status"] = HttpCode::CREATED;
            return $results;
        }

        public function logout()
        {
            auth()->logout();
            return ['message' => 'User successfully signed out'];
        }

        public function refresh()
        {
            return $this->createNewToken(auth()->refresh());
        }
    }
