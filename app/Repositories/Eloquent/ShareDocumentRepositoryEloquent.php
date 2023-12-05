<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Document;
    use App\Models\Document_account;
    use App\Repositories\DocumentRepository;
    use App\Repositories\ShareDocumentRepository;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class ShareDocumentRepositoryEloquent extends BaseRepository implements ShareDocumentRepository
    {

        public function model()
        {
            return Document_account::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

    }
