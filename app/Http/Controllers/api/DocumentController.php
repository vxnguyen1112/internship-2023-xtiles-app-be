<?php

    namespace App\Http\Controllers\api;

    use App\Helpers\CommonResponse;
    use App\Helpers\HttpCode;
    use App\Helpers\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreDocumentRequest;
    use App\Services\DocumentService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class DocumentController extends Controller
    {
        protected $documentService;

        public function __construct(DocumentService $documentService)
        {
            $this->documentService = $documentService;
        }

        public function getDocumentPersonal()
        {
            return ResponseHelper::send($this->documentService->getDocumentPersonal(), statusCode: HttpCode::CREATED);
        }

        public function getDocumentByQuery(Request $request)
        {
            $query = $request->only(['name', 'is_deleted', 'workspace_id']);
            return ResponseHelper::send($this->documentService->getDocumentByQuery($query),
                statusCode: HttpCode::CREATED);
        }

        public function getDocumentById($id)
        {
            return ResponseHelper::send($this->documentService->getDocumentById($id), statusCode: HttpCode::CREATED);
        }

        public function store(StoreDocumentRequest $request)
        {
            $result = $this->documentService->store($request->all());
            return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
        }

        public function update(Request $request, $id)
        {
            $result = $this->documentService->update($request->except(['workspace_id', 'account_id']), $id);
            if ($result === HttpCode::NOT_FOUND) {
                return CommonResponse::notFoundResponse();
            }
            return ResponseHelper::send($result, statusCode: HttpCode::OK);
        }

        public function destroy($id)
        {
            $result = $this->documentService->delete($id);
            if ($result === HttpCode::NOT_FOUND) {
                return CommonResponse::notFoundResponse();
            }
            return CommonResponse::deleteSuccessfullyResponse();
        }
    }
