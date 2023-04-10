<?php

    namespace App\Repositories;

    use Prettus\Repository\Contracts\RepositoryInterface;

    interface CommentRepository extends RepositoryInterface
    {
        public function checkCommentId($id);

        public function checkContentId($contentId);

        public function checkDocumentId($documentId);

        public function getCommentByDocument($documentId);

        public function getCommentByContent($contentId);
    }
