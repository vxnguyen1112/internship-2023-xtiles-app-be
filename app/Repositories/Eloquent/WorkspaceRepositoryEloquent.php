<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Workspace;
    use App\Repositories\WorkspaceRepository;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class WorkspaceRepositoryEloquent extends BaseRepository implements WorkspaceRepository
    {
        public function model()
        {
            return Workspace::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

        public function checkWorkspaceById($id)
        {
            return Workspace::where(['id'=>$id,"account_id"=>auth()->user()['id']])->exists();
        }
    }
