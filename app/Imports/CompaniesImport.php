<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class CompaniesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Ensure that 'company_email' exists in the row
        if (!isset($row['company_email'])) {
            // Handle the case where the 'company_email' column is missing
            return null; // Or throw an exception, or log an error
        }

        $existingCompany = Company::where('company_email', $row['company_email'])->first();

        if ($existingCompany) {
            $existingCompany->update([
                'company_name' => $row['company_name'],
                // Update other fields as needed
            ]);
            return $existingCompany;
        }

        return new Company([
            'company_name' => $row['company_name'],
            // 'company_email' => $row['company_email'],
            'type_of_deal' => $row['type_of_deal'],
            // 'company_password' => Hash::make($row['company_password']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
