<?php

    namespace App\Http\Controllers\api;

    use App\Helpers\CommonResponse;
    use App\Helpers\DocumentMessage;
    use App\Helpers\HttpCode;
    use App\Helpers\ResponseHelper;
    use App\Helpers\Status;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreFavouriteDocumentRequest;
    use App\Http\Requests\StorePageRequest;
    use App\Models\Favourite_document;
    use App\Services\FavouriteDocumentService;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class FavouriteDocumentController extends Controller
    {
        protected $favouriteDocumentService;

        public function __construct(FavouriteDocumentService $favouriteDocumentService)
        {
            $this->favouriteDocumentService = $favouriteDocumentService;
        }

        public function store(StoreFavouriteDocumentRequest $request)
        {
            $result = $this->favouriteDocumentService->store($request->all());
            if ($result === HttpCode::NOT_FOUND) {
                return ResponseHelper::send($result, Status::NOT_GOOD, HttpCode::NOT_FOUND, DocumentMessage::INVALID);
            }
            return ResponseHelper::send($result);
        }

        public function getAllFavouriteOfAccount()
        {
            return ResponseHelper::send($this->favouriteDocumentService->getAllFavouriteOfAccount());
        }

    }
