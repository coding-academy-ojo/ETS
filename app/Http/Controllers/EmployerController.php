<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\employeer_trainee;
use App\Models\Company;
use App\Exports\EmployeesExport; // Correct namespace for EmployeesExport
use App\Imports\EmployeesImport; // Correct namespace for EmployeesImport
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Trainee;
use Illuminate\Support\Facades\Auth;


class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
         return view('employer.index');

     }
     public function addToShortlisted(Request $request)
     {
        $employee_id = $request->input('employee_id');
        $trainee_id = $request->input('trainee_id');


        employeer_trainee::create([
            'employee_id' => $employee_id,
            'trainee_id' => $trainee_id,
        ]);

        return redirect()->back();
    }
    public function showShortList()
    {
        // dd(Auth::guard('employer')->user()->id);
        $employer_id=Auth::guard('employer')->user()->id;

        $trainee_ids = employeer_trainee::where('employee_id', $employer_id)
        ->pluck('trainee_id')
        ->toArray();
        // dd($trainee_ids);
    // Fetch trainee information based on the trainee_ids
    $trainees = Trainee::whereIn('id', $trainee_ids)->get();
    // dd($trainees);
        return view('employer.shortListTrainee',compact('trainees'));
    }

    // delete unwanted trainee from shortlisted function
    public function showTraineeListUpdate($id){
        // dd($id);
        $employer_id=Auth::guard('employer')->user()->id;
        employeer_trainee::where('trainee_id', $id)
        ->where('employee_id', $employer_id)
        ->delete();

        return redirect()->back();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trainee = Trainee::findOrFail($id);
        $isShortlisted = employeer_trainee::where('employee_id', Auth::guard('employer')->user()->id)
                                          ->where('trainee_id', $id)
                                          ->exists();
      // dd($trainee);
        return view('employer.trainee_information', compact('trainee', 'isShortlisted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $up_employee=Employer::findOrFail($id);
//        dd($up_employee);
        return view('companies.em_edit', compact('up_employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employer $employer)
    {
        $employer = Employer::findOrFail($request->id);
        $employer->name = $request->name;
        $employer->email = $request->email;
        $employer->save();
        return redirect()
            ->route('companies.show', $employer->company_id)
            ->with('success', 'Employer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId)
    {
        // Find the employee by its ID
        $employee = Employer::findOrFail($employeeId);
        $employee->status = 'inactive';
        $employee->save();
        // Delete the employee//  $employee->delete();
        // Redirect with a success message
        return redirect()->route('companies.showAll')->with('success', 'Employee deleted successfully.');
    }


    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new EmployeesImport, $request->file('file'));

        return redirect()->back()->with('success', 'Employees imported successfully!');
    }

    public function inactive_emp(){
        // dd("inactive");
    }


    public function fillter(Request $request)
{
    dd('hello');
    // Get the search query from the request
    $search = $request->input('search');

    // Query to fetch employees with filtering
    $employees = Employer::query()
        ->whereHas('company', function ($query) use ($search) {
            $query->where('company_name', 'like', '%' . $search . '%');
        })
        ->orWhere('name', 'like', '%' . $search . '%')
        ->orWhere('id', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%')
     ->paginate(10); // Adjust pagination as needed

     return view('companies/showAll', compact('employees' ,'search'));

}
}
