<?php

    namespace App\Services;

    use App\Helpers\HttpCode;
    use App\Models\Block;
    use App\Repositories\AccountRepository;
    use App\Repositories\BlockRepository;
    use App\Repositories\DocumentRepository;
    use App\Repositories\ShareDocumentRepository;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Log;

    class ShareDocumentService
    {
        protected $shareDocumentRepository;
        protected $accountRepository;
        protected $documentRepository;

        /**
         * @param $shareDocumentRepository
         */


        public function __construct(
            ShareDocumentRepository $shareDocumentRepository,
            AccountRepository $accountRepository,
            DocumentRepository $documentRepository
        ) {
            $this->shareDocumentRepository = $shareDocumentRepository;
            $this->accountRepository = $accountRepository;
            $this->documentRepository = $documentRepository;
        }

        public function sendEmailInvite($data)
        {
            if (is_null($this->documentRepository->findWhere([
                'id' => $data['document_id'],
                'account_id' => auth()->user()['id'],
                'is_deleted' => false
            ])->first())) {
                return HttpCode::FORBIDDEN;
            }
            if (is_null($this->accountRepository->findWhere(['email' => $data['email']])->first())) {
                $this->accountRepository->create(['email' => $data['email'], 'is_verified' => false]);
            }
            $data['account_id'] = $this->accountRepository->findWhere(['email' => $data['email']])->first()['id'];
            $documentShare = $this->shareDocumentRepository->findWhere([
                'account_id' => $data['account_id'],
                'document_id' => $data['document_id'],
            ])->first();
            if (!is_null($documentShare)) {
                if ($documentShare['is_accepted']) {
                    return HttpCode::CONFLICT;
                }
                $this->shareDocumentRepository->delete($documentShare['id']);
            }
            return $this->shareDocumentRepository->create($data);
        }

        public function acceptInvite($token)
        {
            $decode = Crypt::decryptString($token);
            $data = json_decode($decode, true);
            $date = Carbon::parse($data['expires_in']['date']);
            if ($data['account_id'] !== auth()->user()['id'] || $date->isPast()) {
                $this->shareDocumentRepository->delete($data['id']);
                $account = $this->accountRepository->findWhere([
                    'id' => $data['account_id'],
                    'is_verified' => false
                ])->first();
                if (!is_null($account)) {
                    $this->accountRepository->delete($account['id']);
                }
                return HttpCode::FORBIDDEN;
            }
            return $this->updateVerify(['is_accepted' => true], $data['id']);
        }

        public function updateVerify($data, $id)
        {
            $shareDocument = $this->shareDocumentRepository->findWhere([
                'id' => $id,
                'is_accepted' => false
            ])->first();
            if (is_null($shareDocument)) {
                return HttpCode::NOT_FOUND;
            }
            return $this->shareDocumentRepository->update($data, $id);
        }

        public function changePermission($role, $id)
        {
            return $this->shareDocumentRepository->update($role, $id);
        }
    }
