<?php

    namespace App\Http\Middleware;

    use App\Helpers\CommonResponse;
    use App\Helpers\Permission;
    use App\Helpers\RequestMethod;
    use App\Repositories\DocumentRepository;
    use App\Repositories\ShareDocumentRepository;
    use Closure;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;
    use Psy\Readline\Hoa\Console;

    class CheckPermission
    {

        protected $shareDocumentRepository;
        protected $documentRepository;

        /**
         * @param $shareDocumentRepository
         * @param $documentRepository
         */
        public function __construct(
            ShareDocumentRepository $shareDocumentRepository,
            DocumentRepository $documentRepository
        ) {
            $this->shareDocumentRepository = $shareDocumentRepository;
            $this->documentRepository = $documentRepository;
        }

        /**
         * Handle an incoming request.
         *
         * @param \Illuminate\Http\Request $request
         * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        function handle(Request $request, Closure $next)
        {
            $routeParam=$request->route()->parameters();
            if (!array_key_exists('document_id',$routeParam )) {
                return CommonResponse::forbiddenResponse();
            }
            $accountId=auth()->user()['id'];
            $document=$this->documentRepository->findWhere([
                    'id' =>  $routeParam['document_id'],
                    'account_id' => $accountId,
                    'is_deleted' => false
                ]
            )->first();
            if (!is_null($document)) {
                return $next($request);
            }
            $role = $this->shareDocumentRepository->findWhere([
                'document_id' => $routeParam['document_id'],
                'account_id' => $accountId,
                'is_accepted' => true
            ])->first();
            if (is_null($role)) {
                return CommonResponse::forbiddenResponse();
            }
            $method = $request->method();
            if ($method === RequestMethod::GET && $role['role'] === Permission::VIEW) {
                return $next($request);
            }
            return $next($request);
        }
    }
