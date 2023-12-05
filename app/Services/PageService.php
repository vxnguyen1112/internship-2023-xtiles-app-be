<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Repositories\PageRepository;

    class PageService
    {
        protected $pageRepository;

        /**
         * @param $pageRepository
         */
        public function __construct(PageRepository $pageRepository)
        {
            $this->pageRepository = $pageRepository;
        }

        public function getPageByQuery($query)
        {
            if (array_key_exists('name', $query)) {
                array_push($query, ['name', 'like', '%' . addslashes($query['name']) . '%']);
                unset($query['name']);
            }
            return $this->pageRepository->findWhere($query);
        }

        public function getPageById($id)
        {
            return $this->pageRepository->find($id);
        }

        public function getAllDataOfPage($id)
        {
            if (!$this->pageRepository->checkPageById($id)) {
                return HttpCode::NOT_FOUND;
            }
            return $this->pageRepository->getAllDataOfPage($id);
        }


        public function store($data)
        {
            return $this->pageRepository->create($data);
        }

        public function update($data, $id)
        {
            if (!$this->pageRepository->checkPageById($id)) {
                return HttpCode::NOT_FOUND;
            }
            return $this->pageRepository->update($data, $id);
        }

        public function delete($id)
        {
            if (!$this->pageRepository->checkPageById($id)) {
                return HttpCode::NOT_FOUND;
            }
            return $this->pageRepository->delete($id);
        }
    }
