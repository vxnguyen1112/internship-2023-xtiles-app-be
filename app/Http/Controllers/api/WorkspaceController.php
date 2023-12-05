<?php

    namespace App\Http\Controllers\api;

    use App\Helpers\CommonResponse;
    use App\Helpers\HttpCode;
    use App\Helpers\ResponseHelper;
    use App\Helpers\Status;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreWorkspaceRequest;
    use App\Services\WorkSpaceService;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    class WorkspaceController extends Controller
    {
        protected $workspaceService;

        public function __construct(WorkSpaceService $workspaceService)
        {
            $this->workspaceService = $workspaceService;
        }

        public function store(StoreWorkspaceRequest $request)
        {
            $result = $this->workspaceService->store($request->except('account_id'));
            return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
        }

        public function update(Request $request, $id)
        {
            if (!$request->filled('name')) {
                return ResponseHelper::send([], Status::NOT_GOOD, HttpCode::BAD_REQUEST,
                    "The name field cannot be null");
            }
            $result = $this->workspaceService->update($request->except('account_id'), $id);
            if ($result === HttpCode::NOT_FOUND) {
                return CommonResponse::notFoundResponse();
            }
            return ResponseHelper::send($result, statusCode: HttpCode::OK);
        }

        public function getWorkspaceByAccountId()
        {
            return ResponseHelper::send($this->workspaceService->getWorkspaceByAccountId(),
                statusCode: HttpCode::CREATED);
        }

        public function delete($id)
        {
            try {
                DB::beginTransaction();
                $result = $this->workspaceService->delete($id);
                if ($result === HttpCode::NOT_FOUND) {
                    return CommonResponse::notFoundResponse();
                }
                DB::commit();
                return CommonResponse::deleteSuccessfullyResponse();
            } catch (ModelNotFoundException $e) {
                Log::error($e);
                return CommonResponse::notFoundResponse();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e);
                return CommonResponse::unknownResponse();
            }
        }

    }
