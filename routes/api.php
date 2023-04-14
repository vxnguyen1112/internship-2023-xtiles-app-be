<?php

    use App\Http\Controllers\api\BlockController;
    use App\Http\Controllers\api\CommentController;
    use App\Http\Controllers\api\ContentController;
    use App\Http\Controllers\api\PageController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\api\AuthController;
    use App\Http\Controllers\api\DocumentController;
    use App\Http\Controllers\api\WorkspaceController;
    use App\Http\Controllers\api\ShareDocumentController;
    use App\Http\Controllers\api\FavouriteDocumentController;
    use App\Http\Controllers\api\UploadController;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::group([
        'prefix' => "auth"
    ], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
    });
    Route::group([
        'middleware' => 'auth'
    ], function () {
        Route::group(
            [
                'prefix' => "auth"
            ],
            function () {
                Route::post('/logout', [AuthController::class, 'logout']);
                Route::post('/refresh', [AuthController::class, 'refresh']);
                Route::get('/user-profile', [AuthController::class, 'userProfile']);
                Route::post('/change-pass', [AuthController::class, 'changePassWord']);
            }
        );
        Route::post('/document/{document_id}/favourite', [FavouriteDocumentController::class, 'store']);
        Route::get('/document/share', [ShareDocumentController::class, 'getAllDocumentShareOfAccount']);
        Route::get('/document/{document_id}/role', [ShareDocumentController::class, 'getListRoleShare']);
        Route::get('/document/favourite', [FavouriteDocumentController::class, 'getAllFavouriteOfAccount']);
        Route::get('/document', [DocumentController::class, 'getDocumentByQuery']);
        Route::get('/document/personal', [DocumentController::class, 'getDocumentPersonal']);
        Route::put('/document/{id}/role', [ShareDocumentController::class, 'update']);
        Route::post('/document', [DocumentController::class, 'store']);

        Route::post('/document/accept', [ShareDocumentController::class, 'acceptInvite']);

        Route::get('/workspace', [WorkspaceController::class, 'getWorkspaceByAccountId']);
        Route::post('/workspace', [WorkspaceController::class, 'store']);
        Route::put('/workspace/{id}', [WorkspaceController::class, 'update']);
        Route::delete('/workspace/{id}', [WorkspaceController::class, 'delete']);
        Route::group(
            [
                'middleware' => 'permission'
            ],
            function () {
            Route::get('/document/{document_id}/page/{pageId}/block', [BlockController::class, 'getBlockByPage']);
            Route::get('/document/{document_id}/block/{id}', [BlockController::class, 'getBlockById']);
            Route::post('/document/{document_id}/block', [BlockController::class, 'store']);
            Route::put('/document/{document_id}/block/{id}', [BlockController::class, 'update']);
            Route::delete('/document/{document_id}/block/{id}', [BlockController::class, 'delete']);

            Route::get('/document/{document_id}', [DocumentController::class, 'getDocumentById']);
            Route::get('/document/{document_id}/all', [DocumentController::class, 'getAllDataDocument']);
            Route::put('/document/{document_id}', [DocumentController::class, 'update']);
            Route::delete('/document/{document_id}', [DocumentController::class, 'destroy']);

            Route::get('/document/{document_id}/page', [PageController::class, 'getPageByQuery']);
            Route::get('/document/{document_id}/page/{id}', [PageController::class, 'getPageById']);
            Route::post('/document/{document_id}/page', [PageController::class, 'store']);
            Route::put('/document/{document_id}/page/{id}', [PageController::class, 'update']);
            Route::delete('/document/{document_id}/page/{id}', [PageController::class, 'destroy']);

            Route::get('/document/{document_id}/comment/{id}', [CommentController::class, 'getCommentById']);
            Route::get('/document/{document_id}/comment', [CommentController::class, 'getCommentByDocument']);
            Route::get('/document/{document_id}/content/{contentId}/comment', [CommentController::class, 'getCommentByContent']);
            Route::post('/document/{document_id}/comment', [CommentController::class, 'store']);
            Route::put('/document/{document_id}/comment/{id}', [CommentController::class, 'update']);
            Route::delete('/document/{document_id}/comment/{id}', [CommentController::class, 'delete']);

            Route::get('/document/{document_id}/block/{blockId}/content', [ContentController::class, 'getContentByBlock']);
            Route::get('/document/{document_id}/content/{id}', [ContentController::class, 'getContentById']);
            Route::post('/document/{document_id}/content', [ContentController::class, 'store']);
            Route::put('/document/{document_id}/content/{id}', [ContentController::class, 'update']);
            Route::delete('/document/{document_id}/content/{id}', [ContentController::class, 'delete']);

            Route::post('/document/{document_id}/share', [ShareDocumentController::class, 'index']);

            Route::post('/document/{document_id}/content/upload', [UploadController::class, 'uploadToContent']);
            Route::post('/document/{document_id}/content/{content_id}/upload', [UploadController::class, 'updateContent']);
        });
    });
