<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Models\Comment;
    use App\Repositories\CommentRepository;
    use Illuminate\Support\Facades\Log;


    class CommentService
    {
        protected $commentRepository;

        /**
         * @param $commentRepository
         */


        public function __construct(CommentRepository $commentRepository)
        {
            $this->commentRepository = $commentRepository;
        }

        public function getCommentById($id)
        {
            $isExist = $this->commentRepository->checkCommentId($id);
            if (!$isExist) {
                return;
            }
            return $this->commentRepository->find($id);
        }

        public function getCommentByDocument($documentId)
        {
            $isExist = $this->commentRepository->checkDocumentId($documentId);
            if (!$isExist) {
                return;
            }
            return $this->commentRepository->getCommentByDocument($documentId);
        }

        public function getCommentByContent($contentId)
        {
            $isExist = $this->commentRepository->checkContentId($contentId);
            if (!$isExist) {
                return;
            }
            return $this->commentRepository->getCommentByContent($contentId);
        }

        public function update($data, $id)
        {
            $isExist = $this->commentRepository->checkCommentId($id);
            if (!$isExist) {
                return;
            }
            return $this->commentRepository->update($data, $id);
        }

        public function store($data)
        {
            $user = auth()->user();
            $data['account_id'] = $user['id'];
            return $this->commentRepository->create($data);
        }

        public function delete($id)
        {
            $isExist = $this->commentRepository->checkCommentId($id);
            if (!$isExist) {
                return;
            }
            return $this->commentRepository->delete($id);
        }
    }
