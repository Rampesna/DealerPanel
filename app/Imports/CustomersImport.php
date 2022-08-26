<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(
        $test
    )
    {
        return $test;
    }
}
