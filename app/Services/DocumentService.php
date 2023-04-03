<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Repositories\DocumentRepository;
    use App\Repositories\FavouriteDocumentRepository;
    use App\Repositories\PageRepository;
    use Illuminate\Support\Facades\Log;

    class DocumentService
    {
        protected $documentRepository;
        protected $pageRepository;
        protected $favouriteDocumentRepository;

        /**
         * @param $documentRepository
         * @param $pageRepository
         */
        public function __construct(
            DocumentRepository $documentRepository,
            PageRepository $pageRepository,
            FavouriteDocumentRepository $favouriteDocumentRepository,
        ) {
            $this->documentRepository = $documentRepository;
            $this->pageRepository = $pageRepository;
            $this->favouriteDocumentRepository = $favouriteDocumentRepository;
        }

        public function store($data)
        {
            $user = auth()->user();
            $data['account_id'] = $user['id'];
            $result = $this->documentRepository->create($data);
            $page = ['name' => 'Untitled', 'document_id' => $result['id']];
            $this->pageRepository->create($page);
            return $result;
        }

        public function update($data, $id)
        {
            if (!$this->documentRepository->checkDocumentById($id)) {
                return HttpCode::NOT_FOUND;
            }
            return $this->documentRepository->update($data, $id);
        }

        public function delete($id)
        {
            return $this->update(['is_deleted' => true], $id);
        }

        public function getDocumentPersonal()
        {
            $user = auth()->user();
            return $this->documentRepository->getDocumentPersonal($user['id']);
        }

        public function getAllDataOfDocument($id)
        {
            if (!$this->documentRepository->checkDocumentById($id)) {
                return HttpCode::NOT_FOUND;
            }
            $data = $this->documentRepository->getAllDataOfDocument($id);
            $data['is_favourite'] = !is_null($this->favouriteDocumentRepository->findWhere([
                'account_id' => auth()->user()['id'],
                'document_id' => $id
            ])->first());
            return $data;
        }

        public function getDocumentByQuery($query)
        {
            $default = ['is_deleted' => false, 'account_id' => auth()->user()['id']];
            $query = array_replace($default, $query);
            if (array_key_exists('name', $query)) {
                array_push($query, ['name', 'like', '%' . addslashes($query['name']) . '%']);
                unset($query['name']);
            }
            return $this->documentRepository->findWhere($query);
        }

        public function getDocumentById($id)
        {
            if (!$this->documentRepository->checkDocumentById($id)) {
                return HttpCode::NOT_FOUND;
            }
            return $this->documentRepository->findWhere(['id' => $id, 'is_deleted' => false]);
        }
    }
