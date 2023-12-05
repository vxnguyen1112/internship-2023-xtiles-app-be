<?php

    namespace App\Http\Requests;

    use App\Helpers\HttpCode;
    use App\Helpers\ResponseHelper;
    use App\Helpers\Status;
    use Illuminate\Contracts\Validation\Validator;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Http\Exceptions\HttpResponseException;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Validation\ValidationException;

    class UpdateContentRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, mixed>
         */
        public function rules()
        {
            return [
                'image' => 'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
                'content_id' => 'required|string|exists:contents,id',
            ];
        }

        public function all($keys = null)
        {
            $data = parent::all($keys);
            $data['content_id'] = $this->route('content_id');
            return $data;
        }

        protected function failedValidation(Validator $validator)
        {
            $validator_errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(ResponseHelper::send([], Status::NOT_GOOD, HttpCode::BAD_REQUEST,
                reset($validator_errors)[0]));
        }
    }
