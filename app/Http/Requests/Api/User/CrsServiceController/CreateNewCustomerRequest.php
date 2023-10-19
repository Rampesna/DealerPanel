<?php

namespace App\Http\Requests\Api\User\CrsServiceController;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateNewCustomerRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required',
            'vkTckNo' => 'required',
            'typeEnum' => 'required',
            'taxOffice' => 'required',
            'ownerTypeEnum' => 'required',
            'webSite' => 'required',
            'addressCountry' => 'required',
            'addressCity' => 'required',
            'addressSubDivisionName' => 'required',
            'addressStreetName' => 'required',
            'surname' => 'required',
            'contactName' => 'required',
            'contactPhone' => 'required',
            'contactEmail' => 'required',
            'parentCustomer' => 'required',
            'sourceType' => 'required',
            'sourceTypeEnum' => 'required',
//            'businessDescription' => 'required',
            'email' => 'required',
//            'faxNumber' => 'required',
            'fiscalYearMonth' => 'required',
            'phoneNumber' => 'required',
            'phoneTypeEnum' => 'required',
//            'notificationEmails' => 'required',
            'createDefaultUsers' => 'required',
            'usersType' => 'required',
            'usersUsername' => 'required',
//            'usersPassword' => 'required',
            'usersFirstName' => 'required',
            'usersSurname' => 'required',
            'usersEmail' => 'required',
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
