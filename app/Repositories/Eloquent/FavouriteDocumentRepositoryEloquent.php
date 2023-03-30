<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Favourite_document;
    use App\Repositories\FavouriteDocumentRepository;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class FavouriteDocumentRepositoryEloquent extends BaseRepository implements FavouriteDocumentRepository
    {

        public function model()
        {
            return Favourite_document::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

    }
