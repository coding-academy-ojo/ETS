<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeLog;
use App\Models\Trainee;
use App\Models\Role;
use Illuminate\Validation\Rule;

class EmploymentLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee_logs = EmployeeLog::paginate(10);
      
        return view('employment-status.employment_log', compact('employee_logs'));
    }

    

    public function store(Request $request)
{
    $data = $request->all();

    if (!$request->has('has_end_date')) {
        $data['end_date'] = 'until now'; // Set your default end date here
    }

    // Save data to the database
    // Example: YourModel::create($data);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_logs = EmployeeLog::findOrFail($id);
        return view('employment-status.employment_edit', compact('employee_logs'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in(['Internship', 'Job Offer', 'Freelance'])],
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $employee_logs = EmployeeLog::findOrFail($id);
        $employee_logs->update($request->all());
        return redirect()->back()->with('success', 'Logs updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee_logs = EmployeeLog::findOrFail($id);
        $employee_logs->delete();
        return redirect()->back()->with('success', 'Logs deleted successfully');
    }


    public function searchCompanies(Request $request)
    {
        $query = $request->get('q');
        $companies = Company::where('company_name', 'LIKE', "%{$query}%")->get();
    
        return response()->json($companies);
    }


    


}
