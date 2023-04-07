<?php

    namespace App\Http\Controllers\api;

    use App\Helpers\CommonResponse;
    use App\Helpers\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\UpdateContentRequest;
    use App\Http\Requests\UploadImageRequest;
    use App\Models\Content;
    use App\Services\ContentService;
    use Cloudinary\Api\Upload\UploadApi;
    use Illuminate\Http\Request;
    use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
    use Cloudinary\Configuration\Configuration;

    class UploadController extends Controller
    {
        protected $contentService;

        public function __construct(ContentService $contentService)
        {
            $this->contentService = $contentService;
        }

        public function upload($image)
        {
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            $result['public_id'] = $uploadedFile->getPublicId();
            $result['store_url'] = $uploadedFile->getSecurePath($result['public_id']);
            return $result;
        }

        public function uploadToContent(UploadImageRequest $request)
        {
            $block_id = $request->input('block_id');
            $image = $request->file('image');
            $data = $this->upload($image);
            $data = array_merge($data, ["block_id" => $block_id, 'type' => 'image']);
            $result = $this->contentService->store($data);
            return ResponseHelper::send($result);
        }

        public function updateContent(UpdateContentRequest $request)
        {
            $content_id = $request["content_id"];
            $image = $request->file('image');
            $data = $this->upload($image);
            $result = $this->contentService->update($data, $content_id);
            return ResponseHelper::send($result);
        }

    }
