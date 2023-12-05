<?php

    namespace App\Observers;

    use App\Events\Event;
    use App\Helpers\Permission;
    use App\Models\Document_account;
    use App\Services\DocumentService;
    use App\Services\NotificationService;

    class ShareDocumentObserver
    {
        protected $documentService;
        protected $notificationService;
        protected $shareEvent;

        public function __construct(DocumentService $documentService, NotificationService $notificationService)
        {
            $this->documentService = $documentService;
            $this->notificationService = $notificationService;

        }

        /**
         * Handle the Document_account "created" event.
         *
         * @param \App\Models\Document_account $document_account
         * @return void
         */
        public function created(Document_account $document_account)
        {
            $this->shareEvent = new Event($document_account['account_id']);
            $email = auth()->user()['email'];
            $account_id = auth()->user()['id'];
            $nameDocument = $this->documentService->getDocumentById($document_account['document_id'])[0]['name'];
            $description = "<b class='text-mail'>" . $email . "</b> <br>invited you to <b class='text-document'>" . $nameDocument . "</b> as <b class='text-permission' >" . Permission::getRole($document_account['role']) . "</b >. Please check mail.";
            $data = [
                'description' => $description,
                'document_id' => $document_account['document_id'],
                'account_id' => $document_account['account_id']
            ];
            $result = $this->notificationService->store($data);
            event($this->shareEvent->create('share-document', $account_id, $result));
        }

    }
