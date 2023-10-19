<?php

namespace App\CrsService;

class ApiService extends CrsService
{
    public function CreateNewCustomer(
        mixed $name,
        mixed $vkTckNo,
        mixed $typeEnum,
        mixed $taxOffice,
        mixed $ownerTypeEnum,
        mixed $webSite,
        mixed $addressCountry,
        mixed $addressCity,
        mixed $addressSubDivisionName,
        mixed $addressStreetName,
        mixed $surname,
        mixed $contactName,
        mixed $contactPhone,
        mixed $contactEmail,
        mixed $parentCustomer,
        mixed $sourceType,
        mixed $sourceTypeEnum,
        mixed $businessDescription,
        mixed $email,
        mixed $faxNumber,
        mixed $fiscalYearMonth,
        mixed $phoneNumber,
        mixed $phoneTypeEnum,
        mixed $notificationEmails,
        mixed $createDefaultUsers,
        mixed $usersType,
        mixed $usersUsername,
//        mixed $usersPassword,
        mixed $usersFirstName,
        mixed $usersSurname,
        mixed $usersEmail
    )
    {
        $data = [
            'Action' => 'CreateNewCustomer',
            'parameters' => [
                'userInfo' => [
                    'Username' => $this->username,
                    'Password' => $this->password
                ],
                'request' => [
                    'Customer' => [
                        'Name' => $name,
                        'VkTckNo' => $vkTckNo,
                        'TypeEnum' => $typeEnum,
                        'TaxOffice' => $taxOffice,
                        'OwnerTypeEnum' => $ownerTypeEnum,
                        'WebSite' => $webSite,
                        'AddressCountry' => $addressCountry,
                        'AddressCity' => $addressCity,
                        'AddressSubDivisionName' => $addressSubDivisionName,
                        'AddressStreetName' => $addressStreetName,
                        'Surname' => $surname,
                        'ContactName' => $contactName,
                        'ContactPhone' => $contactPhone,
                        'ContactEmail' => $contactEmail,
                        'ParentCustomer' => $parentCustomer,
                        'SourceType' => $sourceType,
                        'SourceTypeEnum' => $sourceTypeEnum
                    ],
                    'Company' => [
                        'BusinessDescription' => $businessDescription,
                        'Email' => $email,
                        'FaxNumber' => $faxNumber,
                        'FiscalYearMonth' => $fiscalYearMonth,
                        'PhoneNumber' => $phoneNumber,
                        'PhoneTypeEnum' => $phoneTypeEnum
                    ],
                    'NotificationEmails' => [
                        $notificationEmails
                    ],
                    'CreateDefaultUsers' => $createDefaultUsers,
                    'Users' => [
                        [
                            'Type' => $usersType,
                            'Username' => $usersUsername,
//                            'Password' => $usersPassword,
                            'FirstName' => $usersFirstName,
                            'Surname' => $usersSurname,
                            'Email' => $usersEmail
                        ]
                    ]
                ]
            ]
        ];


        $response = $this->callApi(
            $this->baseUrl,
            'post',
            [],
            $data
        );

        $decodedResponse = json_decode($response->body());

        if ($decodedResponse->Data->IsSucceded == true) {
            return response()->json([
                'message' => 'İşlem başarılı.',
                'data' => $decodedResponse
            ], 200);
        } else {
            return response()->json([
                'message' => 'Bir hata oluştu. Lütfen tekrar deneyiniz.',
                'data' => $decodedResponse
            ], 400);
        }
    }
}
