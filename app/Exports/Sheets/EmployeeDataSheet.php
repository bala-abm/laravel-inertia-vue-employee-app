<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\Employees;

class EmployeeDataSheet implements FromCollection, WithHeadings , ShouldAutoSize, WithMapping, WithTitle
{
    use Exportable;

    public function collection()
    {
        return Employees::select('employees.*', 'et.employee_name')->leftJoin('employee_translations AS et', function($join){
                $join->on('employees.id', '=', 'et.employee_id')->where('et.language_code', '=', 'EN');
            })->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name (From English Translation )', 'Email', 'Phone', 'Status', 'Created At', 'Updated At'];
    }

    public function map($row): array
    {
        return [$row->id, $row->employee_name, $row->email, $row->phone, $row->status, date('M d Y', strtotime($row->created_at)), date('M d Y', strtotime($row->updated_at))];
    }

    public function title(): string
    {
        return 'Basic Info';
    }

    
}
