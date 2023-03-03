<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Repositories\DocumentRepository;
    use App\Repositories\WorkspaceRepository;
    use Illuminate\Support\Facades\Log;

    class WorkSpaceService
    {
        protected $workspaceRepository;
        protected $documentRepository;

        /**
         * @param $workspaceRepository
         */
        public function __construct(WorkspaceRepository $workspaceRepository, DocumentRepository $documentRepository)
        {
            $this->workspaceRepository = $workspaceRepository;
            $this->documentRepository = $documentRepository;
        }

        public function store($data)
        {
            $user = auth()->user();
            $data['account_id'] = $user['id'];
            return $this->workspaceRepository->create($data);
        }

        public function update($data, $id)
        {
            if (!$this->workspaceRepository->checkWorkspaceById($id)) {
                return HttpCode::NOT_FOUND;
            }
            return $this->workspaceRepository->update($data, $id);
        }

        public function getWorkspaceByAccountId()
        {
            return $this->workspaceRepository->findWhere(["account_id" => auth()->user()['id']]);
        }

        public function delete($id)
        {
            if (!$this->workspaceRepository->checkWorkspaceById($id)) {
                return HttpCode::NOT_FOUND;
            }
            $this->documentRepository->deleteDocumentByWorkspace($id);
            return $this->workspaceRepository->delete($id);
        }
    }
