<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\EmployeeTranslations;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Exports\EmployeeDataExport;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware("auth")->except(["index"]);
    }

    public function index()
    {
        return Inertia::render('Employee/Index', [
            "employee" => $this->employeeList()
        ]);
    }

    public function employeeList(){

        return Employees::select('employees.*', 'et.employee_name')->leftJoin('employee_translations AS et', function($join){
                $join->on('employees.id', '=', 'et.employee_id')->where('et.language_code', '=', 'EN');
            })->get();
    }


    public function download() 
    {
        // return true;
        return (new EmployeeDataExport(['EN', 'DE']))->download('employee_data.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Employee/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employees();
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->status = $request->input('status');
        if($employee->save()){
            $translations = [];
            foreach ($request->input('employee_details') as $key => $value) {
                $translations[] = new EmployeeTranslations([
                    'employee_id' => $employee->id,
                    'language_code' => $key,
                    'about_employee' => $value['about_employee'],
                    'street_address' => $value['street_address'],
                    'employee_name' => $value['employee_name'],
                ]);
            }
            $employee->translations()->saveMany($translations);
        }

        $request->session()->flash('success', 'Employee created successfully!');

        return redirect()->route('employee.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employees)
    {
        //
    }
}
