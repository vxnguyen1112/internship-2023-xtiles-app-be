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
        Route::group([
            'prefix' => "auth"
        ], function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/refresh', [AuthController::class, 'refresh']);
            Route::get('/user-profile', [AuthController::class, 'userProfile']);
            Route::post('/change-pass', [AuthController::class, 'changePassWord']);
        }
        );

        Route::get('page/{pageId}/block', [BlockController::class, 'getBlockByPage']);
        Route::get('block/{id}', [BlockController::class, 'getBlockById']);
        Route::post('/block', [BlockController::class, 'store']);
        Route::put('/block/{id}', [BlockController::class, 'update']);
        Route::delete('/block/{id}', [BlockController::class, 'delete']);

        Route::get('/document', [DocumentController::class, 'getDocumentByQuery']);
        Route::get('/document/personal', [DocumentController::class, 'getDocumentPersonal']);
        Route::get('/document/favourite', [FavouriteDocumentController::class, 'getAllFavouriteOfAccount']);
        Route::get('/document/{id}', [DocumentController::class, 'getDocumentById']);
        Route::post('/document', [DocumentController::class, 'store']);
        Route::put('/document/{id}', [DocumentController::class, 'update']);
        Route::delete('/document/{id}', [DocumentController::class, 'destroy']);

        Route::get('/page', [PageController::class, 'getPageByQuery']);
        Route::get('/page/{id}', [PageController::class, 'getPageById']);
        Route::post('/page', [PageController::class, 'store']);
        Route::put('/page/{id}', [PageController::class, 'update']);
        Route::delete('/page/{id}', [PageController::class, 'destroy']);

        Route::get('/comment/{id}', [CommentController::class, 'getCommentById']);
        Route::get('/document/{documentId}/comment', [CommentController::class, 'getCommentByDocument']);
        Route::get('/content/{contentId}/comment', [CommentController::class, 'getCommentByContent']);
        Route::post('/comment', [CommentController::class, 'store']);
        Route::put('/comment/{id}', [CommentController::class, 'update']);
        Route::delete('/comment/{id}', [CommentController::class, 'delete']);

        Route::get('/workspace', [WorkspaceController::class, 'getWorkspaceByAccountId']);
        Route::post('/workspace', [WorkspaceController::class, 'store']);
        Route::put('/workspace/{id}', [WorkspaceController::class, 'update']);
        Route::delete('/workspace/{id}', [WorkspaceController::class, 'delete']);

        Route::get('/document/{document_id}/block/{blockId}/content', [ContentController::class, 'getContentByBlock']);
        Route::get('/document/{document_id}/content/{id}', [ContentController::class, 'getContentById']);
        Route::post('/document/{document_id}/content', [ContentController::class, 'store']);
        Route::put('/document/{document_id}/content/{id}', [ContentController::class, 'update']);
        Route::delete('/document/{document_id}/content/{id}', [ContentController::class, 'delete']);

        Route::post('/document/{document_id}/share', [ShareDocumentController::class, 'index']);
        Route::post('/document/accept', [ShareDocumentController::class, 'acceptInvite']);

        Route::post('/document/{document_id}/favourite', [FavouriteDocumentController::class, 'store']);
    });
