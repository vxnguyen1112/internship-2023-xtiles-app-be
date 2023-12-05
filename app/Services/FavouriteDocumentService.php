<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Models\Account;
    use App\Repositories\AccountRepository;
    use App\Repositories\DocumentRepository;
    use App\Repositories\FavouriteDocumentRepository;
    use App\Repositories\PageRepository;
    use Illuminate\Support\Facades\Log;

    class FavouriteDocumentService
    {
        protected $favouriteDocumentRepository;
        protected $accountRepository;
        protected $documentRepository;

        /**
         * @param $favouriteDocumentRepository
         * @param $accountRepository
         * @param $documentRepository
         */
        public function __construct(
            FavouriteDocumentRepository $favouriteDocumentRepository,
            AccountRepository $accountRepository,
            DocumentRepository $documentRepository
        ) {
            $this->favouriteDocumentRepository = $favouriteDocumentRepository;
            $this->accountRepository = $accountRepository;
            $this->documentRepository = $documentRepository;
        }

        public function getAllFavouriteOfAccount()
        {
            $accountId = auth()->user()['id'];
            $result = $this->accountRepository->getAllFavouriteOfAccount($accountId)->toArray();
            return $result[0]['favourite_document'];
        }

        public function store($data)
        {
            if (!$this->documentRepository->checkDocumentById($data['document_id'])) {
                return HttpCode::NOT_FOUND;
            }
            $data['account_id'] = auth()->user()['id'];
            $result = $data;
            $is_favourite = $data['is_favourite'];
            unset($data['is_favourite']);
            $favouriteDocument = $this->favouriteDocumentRepository->findWhere($data)->first();
            if (!is_null($favouriteDocument) === $is_favourite) {
                return $result;
            }
            if (!is_null($favouriteDocument)) {
                $this->favouriteDocumentRepository->delete($favouriteDocument['id']);
                return $result;
            }
            return $this->favouriteDocumentRepository->create($data);
        }
    }
