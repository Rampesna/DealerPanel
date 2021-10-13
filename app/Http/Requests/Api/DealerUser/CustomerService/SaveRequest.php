<?php

namespace App\Http\Requests\Api\DealerUser\CustomerService;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SaveRequest extends FormRequest
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
     * @return array
     */

    /**
     * @param int|null $id
     * @param int $customer_id
     * @param int $service_id
     * @param \DateTime $start
     * @param \DateTime $end
     * @param double $amount
     * @param int $status_id
     */
    public function rules()
    {
        return [
            'id' => strtolower(request()->method() == 'put') ? 'required' : 'nullable',
            'customer_id' => 'required',
            'service_id' => 'required|int',
            'start' => 'required',
            'end' => 'required',
            'amount' => 'required',
            'status_id' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Request not valid',
                'error' => true,
                'code' => 400,
                'response' => (new ValidationException($validator))->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
