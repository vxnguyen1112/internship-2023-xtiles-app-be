<?php

    namespace App\Repositories\Eloquent;

    use App\Models\Document;
    use App\Repositories\DocumentRepository;
    use Illuminate\Support\Facades\Log;
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
            return Document::where(['account_id' => $idAccount, 'is_deleted' => false])->with([
                'favourite' => function ($query) use ($idAccount) {
                    $query->where('account_id', $idAccount);
                }
            ])->get()->map(function ($row) {
                return [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'is_deleted' => $row['is_deleted'],
                    'img_cover_url' => $row['img_cover_url'],
                    'img_panel_url' => $row['img_panel_url'],
                    'account_id' => $row['account_id'],
                    'workspace_id' => $row['workspace_id'],
                    'updated_at' => $row['updated_at'],
                    'created_at' => $row['created_at'],
                    'favourite' => $row['favourite']->count() ? true : false
                ];
            });
        }

        public function deleteDocumentByWorkspace($workspace_Id)
        {
            Document::where('workspace_id', $workspace_Id)->update(['is_deleted' => true, 'workspace_id' => null]);
        }

        public function getAllDataOfDocument($idDocument)
        {
            $data = Document::where(['id' => $idDocument, 'is_deleted' => false])->with([
                'pages' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                },
                'defaultPage'
            ])->get()->toArray();
            if (is_null($data[0]['default_page'])) {
                $data[0]['blocks'] = [];
                unset($data[0]['default_page']);
                return $data;
            }
            $data[0]['blocks'] = $data[0]['default_page']['blocks'];
            unset($data[0]['default_page']);
            return $data;
        }
    }
