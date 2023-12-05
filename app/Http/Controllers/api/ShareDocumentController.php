<?php

    namespace App\Http\Controllers\api;

    use App\Helpers\CommonResponse;
    use App\Helpers\HttpCode;
    use App\Helpers\ResponseHelper;
    use App\Helpers\Status;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\StoreShareDocumentRequest;
    use App\Jobs\SendEmail;
    use App\Mail\InviteJoinDocument;
    use App\Services\NotificationService;
    use App\Services\ShareDocumentService;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Mail;
    use PhpParser\Node\Stmt\Return_;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Tymon\JWTAuth\Facades\JWTFactory;
    use Illuminate\Support\Facades\Crypt;

    class ShareDocumentController extends Controller
    {
        protected $shareDocumentService;
        protected $notificationService;


        public function __construct(
            ShareDocumentService $shareDocumentService,
            NotificationService $notificationService
        ) {
            $this->shareDocumentService = $shareDocumentService;
            $this->notificationService = $notificationService;
        }


        public function index(StoreShareDocumentRequest $request)
        {
            $result = $this->shareDocumentService->sendEmailInvite($request->except(['account_id', 'is_verified']));
            if ($result === HttpCode::FORBIDDEN) {
                return CommonResponse::forbiddenResponse();
            }
            if ($result === HttpCode::CONFLICT) {
                $message = 'This email already exists in document';
                return ResponseHelper::send($result, Status::NOT_GOOD, HttpCode::BAD_REQUEST, $message);
            }
            $now = new \DateTime();
            $mailData = [
                'title' => 'Mail from Gutta',
                'body' => auth()->user()['email'] . ' invited you to join the document',
                'expires_in' => $now->add(new \DateInterval('PT168H')),
                'id' => $result['id'],
                'account_id' => $result['account_id']
            ];
            $token = Crypt::encryptString(json_encode($mailData));
            $mailData['token'] = $token;
            dispatch(new SendEmail($request['email'], $mailData));
            return ResponseHelper::send($result, statusCode: HttpCode::CREATED);
        }

        public function acceptInvite(Request $request)
        {
            $data = $request->only(['token']);
            try {
                $result = $this->shareDocumentService->acceptInvite($data['token']);
                if ($result === HttpCode::FORBIDDEN) {
                    return CommonResponse::forbiddenResponse();
                }
                if ($result === HttpCode::NOT_FOUND) {
                    return CommonResponse::notFoundResponse();
                }
                return ResponseHelper::send($result, statusCode: HttpCode::OK);
            } catch (ModelNotFoundException $e) {
                Log::error($e);
                return CommonResponse::notFoundResponse();
            } catch (\Exception $e) {
                Log::error($e);
                return CommonResponse::unknownResponse();
            }
        }

        public function getAllDocumentShareOfAccount()
        {
            return ResponseHelper::send($this->shareDocumentService->getAllDocumentShareOfAccount());
        }

        public function getListRoleShare($id)
        {
            return ResponseHelper::send($this->shareDocumentService->getListRoleShare($id));
        }

        public function update(Request $request, $id)
        {
            $result = $this->shareDocumentService->update($request->only(['role']), $id);
            if ($result === HttpCode::NOT_FOUND) {
                return CommonResponse::notFoundResponse();
            }
            return ResponseHelper::send($result);
        }

        public function getNotification()
        {
            return ResponseHelper::send($this->notificationService->getNotification());
        }

        public function checkNotification()
        {
            return ResponseHelper::send($this->notificationService->checkNotification());
        }

        public function destroy(Request $request)
        {
            $result = $this->shareDocumentService->delete($request['id']);
            if ($result === HttpCode::NOT_FOUND) {
                return CommonResponse::notFoundResponse();
            }
            return CommonResponse::deleteSuccessfullyResponse();
        }
    }
