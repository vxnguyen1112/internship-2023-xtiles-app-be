<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Repositories\DocumentRepository;
    use Illuminate\Support\Facades\Log;

    class DocumentService
    {
        protected $documentRepository;

        /**
         * @param $documentRepository
         */
        public function __construct(DocumentRepository $documentRepository)
        {
            $this->documentRepository = $documentRepository;
        }

        public function store($data)
        {
            $user = auth()->user();
            $data['account_id'] = $user['id'];
            return $this->documentRepository->create($data);
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
            return $this->documentRepository->findWhere(['id' => $id, 'is_deleted' => false]);
        }
    }
