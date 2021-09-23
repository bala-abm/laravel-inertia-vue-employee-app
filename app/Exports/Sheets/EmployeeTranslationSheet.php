<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\EmployeeTranslations;

class EmployeeTranslationSheet implements FromCollection, WithHeadings , ShouldAutoSize, WithMapping, WithTitle
{
    use Exportable;

    protected $lang;
    protected $languages = ['EN'=>'English Data', 'DE'=> 'German Data'];

    public function __construct($lang)
    {
        $this->lang = $lang;
    }
    public function collection()
    {
        return EmployeeTranslations::where('language_code',$this->lang)->get();
    }

    public function headings(): array
    {
        return ['ID', 'Employees ID', 'Language Code', 'Employee Name', 'About Employee', 'Street Address', 'Created At', 'Updated At'];
    }

    public function map($row): array
    {
        return [$row->id, $row->employee_id, $row->language_code, $row->employee_name, $row->about_employee, $row->street_address, date('M d Y', strtotime($row->created_at)), date('M d Y', strtotime($row->updated_at))];
    }

    public function title(): string
    {
        return $this->languages[$this->lang];
    }
}