<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Page;
    use App\Repositories\PageRepository;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class PageRepositoryEloquent extends BaseRepository implements PageRepository
    {
        public function model()
        {
            return Page::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

        public function checkPageById($id)
        {
            return Page::where('id', $id)->exists();
        }
    }
