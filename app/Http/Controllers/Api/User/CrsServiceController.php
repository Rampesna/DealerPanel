<?php

namespace App\Http\Controllers\Api\User;

use App\CrsService\ApiService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CrsServiceController\CreateNewCustomerRequest;


class CrsServiceController extends Controller
{
    private $crsService;

    public function __construct()
    {
        $this->crsService = new ApiService();
    }

    public function CreateNewCustomer(CreateNewCustomerRequest $request)
    {
        $response = $this->crsService->CreateNewCustomer(
            $request->name,
            $request->vkTckNo,
            $request->typeEnum,
            $request->taxOffice,
            $request->ownerTypeEnum,
            $request->webSite,
            $request->addressCountry,
            $request->addressCity,
            $request->addressSubDivisionName,
            $request->addressStreetName,
            $request->surname,
            $request->contactName,
            $request->contactPhone,
            $request->contactEmail,
            $request->parentCustomer,
            $request->sourceType,
            $request->sourceTypeEnum,
            $request->businessDescription,
            $request->email,
            $request->faxNumber,
            $request->fiscalYearMonth,
            $request->phoneNumber,
            $request->phoneTypeEnum,
            $request->notificationEmails,
            $request->createDefaultUsers,
            $request->usersType,
            $request->usersUsername,
//            $request->usersPassword,
            $request->usersFirstName,
            $request->usersSurname,
            $request->usersEmail
        );

        return $response;
    }
}
