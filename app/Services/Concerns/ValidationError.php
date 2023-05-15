<?php

namespace App\Services\Concerns;

use App\Services\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationError
{
    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        request()->wantsJson() ?
            $this->apiValidationResponse($validator) :
            parent::failedValidation($validator);
    }

    protected function apiValidationResponse(Validator $validator): void
    {
        throw new HttpResponseException(
            ApiResponse::failed(
                $validator->errors()->first(),
                errors: $validator->errors()->toArray(),
                httpStatusCode: 422
            )
        );
    }
}
