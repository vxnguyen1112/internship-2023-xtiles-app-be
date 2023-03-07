<?php

    use App\Http\Controllers\api\BlockController;
    use App\Http\Controllers\api\PageController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\api\AuthController;
    use App\Http\Controllers\api\DocumentController;

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

        Route::get('/block', [BlockController::class, 'index']);
        Route::post('/block', [BlockController::class, 'store']);
        Route::put('/block/{id}', [BlockController::class, 'update']);
        Route::delete('/block/{id}', [BlockController::class, 'delete']);

        Route::get('/document', [DocumentController::class, 'getDocumentByQuery']);
        Route::get('/document/personal', [DocumentController::class, 'getDocumentPersonal']);
        Route::get('/document/{id}', [DocumentController::class, 'getDocumentById']);
        Route::post('/document', [DocumentController::class, 'store']);
        Route::put('/document/{id}', [DocumentController::class, 'update']);
        Route::delete('/document/{id}', [DocumentController::class, 'destroy']);

        Route::get('/page', [PageController::class, 'getPageByQuery']);
        Route::get('/page/{id}', [PageController::class, 'getPageById']);
        Route::post('/page', [PageController::class, 'store']);
        Route::put('/page/{id}', [PageController::class, 'update']);
        Route::delete('/page/{id}', [PageController::class, 'destroy']);
    });
