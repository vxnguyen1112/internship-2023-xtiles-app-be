<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Document;
    use App\Repositories\DocumentRepository;
    use Prettus\Repository\Criteria\RequestCriteria;
    use Prettus\Repository\Eloquent\BaseRepository;


    class DocumentRepositoryEloquent extends BaseRepository implements DocumentRepository
    {

        public function model()
        {
            return Document::class;
        }

        public function boot()
        {
            $this->pushCriteria(app(RequestCriteria::class));
        }

        public function checkDocumentById($id)
        {
            return Document::where(['id' => $id, 'is_deleted' => false])->exists();
        }

        public function getDocumentPersonal($idAccount)
        {
            return Document::where(['account_id' => $idAccount, 'is_deleted' => false])->get();
        }

        public function deleteDocumentByWorkspace($workspace_Id)
        {
            Document::where('workspace_id', $workspace_Id)->update(['is_deleted' => true, 'workspace_id' => null]);
        }
    }
