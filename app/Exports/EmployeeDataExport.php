<?php 
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Sheets\EmployeeDataSheet;
use App\Exports\Sheets\EmployeeTranslationSheet;

class EmployeeDataExport implements WithMultipleSheets
{
    use Exportable;

    protected $lang;

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [new EmployeeDataSheet()];
        
        foreach ($this->lang as $value) {
            $sheets[] = new EmployeeTranslationSheet($value);
        }

        return $sheets;
    }
}