<?php

    namespace App\Repositories\Eloquent;

    use App\Helpers\MapData;
    use App\Models\Account;
    use App\Models\Block;
    use App\Models\Comment;
    use App\Models\Content;
    use App\Models\Document;
    use App\Repositories\CommentRepository;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
    {

        public function model()
        {
            return Comment::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

        public function checkCommentId($id)
        {
            return Comment::where("id", $id)->exists();
        }

        public function checkContentId($contentId)
        {
            return Content::where("id", $contentId)->exists();
        }

        public function checkDocumentId($documentId)
        {
            return Document::where("id", $documentId)->exists();
        }

        public function getCommentByDocument($documentId)
        {
            return Block::join('contents', 'contents.block_id', '=', 'blocks.id')
                ->join('comments', 'comments.content_id', '=', 'contents.id')
                ->join('accounts', 'accounts.id', '=', 'comments.account_id')
                ->where("document_id", $documentId)
                ->select([
                    'contents.*',
                    'comments.*',
                    'blocks.*',
                    'accounts.*',
                    'comments.id as comment_id',
                    'comments.created_at as comment_created_at',
                    'comments.updated_at as comment_updated_at',
                    'comments.document_id as comment_document_id',
                    'comments.content_id as comment_content_id',
                    'comments.account_id as comment_account_id',
                    'accounts.name as account_name',
                    'contents.name as content_name',
                    'contents.block_id as content_block_id',
                    'contents.position as content_position',
                    'blocks.position as block_position',
                    'blocks.page_id as block_page_id',
                ])
                ->get()
                ->map(function ($row) {
                    return MapData::mapResponse($row, ['comment', 'content', 'block', 'account']);
                });
        }

        public function getCommentByContent($contentId)
        {
            return Account::join('comments', 'accounts.id', '=', 'comments.account_id')
                ->where("content_id", $contentId)
                ->select([
                    'comments.*',
                    'accounts.*',
                    'comments.id as comment_id',
                    'comments.created_at as comment_created_at',
                    'comments.updated_at as comment_updated_at',
                    'comments.document_id as comment_document_id',
                    'comments.content_id as comment_content_id',
                    'comments.account_id as comment_account_id',
                    'accounts.name as account_name',
                ])
                ->get()
                ->map(function ($row) {
                    return MapData::mapResponse($row, ['comment', 'account']);
                });
        }
    }
