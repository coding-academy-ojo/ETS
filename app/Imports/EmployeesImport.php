<?php
namespace App\Imports;

use App\Models\Employer;
use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check if 'company_name' is provided in the row
        if (isset($row['company_name'])) {
            // Find the company by name or create a new one if it doesn't exist
            $company = Company::firstOrCreate(['company_name' => $row['company_name']]);
            $companyId = $company->id;
        } else {
            // Handle the case where 'company_name' is missing
            $companyId = null; // Or set a default value, or throw an error
        }

        return new Employer([
            'name' => $row['name'],
            'email' => $row['email'],
            'company_name' => $row['company_name'],
            'company_id' => $companyId, // Use the matched company ID
        ]);
    }
}





