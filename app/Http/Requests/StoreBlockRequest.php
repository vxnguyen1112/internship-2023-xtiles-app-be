<?php

namespace App\Http\Requests;

use App\Helpers\HttpCode;
use App\Helpers\ResponseHelper;
use App\Helpers\Status;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class StoreBlockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'page_id' => 'required|string|exists:pages,id',
            'position' => 'required',
            'size' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $validator_errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(ResponseHelper::send([], Status::NOT_GOOD, HttpCode::BAD_REQUEST,
            reset($validator_errors)[0]));
    }
}
