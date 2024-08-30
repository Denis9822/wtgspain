<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidation
{
    use ResponseApiAnswer;

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendError('Validation Error', $validator->errors()));
    }
}
