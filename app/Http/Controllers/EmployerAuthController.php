<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Cohort;


class EmployerAuthController extends Controller
{

    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        //dd( $request);
        if ($request->has('email') && $request->has('password')) {
            $credentials = $request->only('email', 'password');
            if (Auth::guard('employer')->attempt($credentials)) {
              return redirect()->route('employer.dashboard');
            }}
        return redirect()->route('empLogin')->withErrors(['email' => 'Invalid credentials']);
    }
    public function showEmployerDashboard() {
      $cohortIds = Cohort::where('cohort_status', 1)->pluck('id');
      // dd($cohortIds);
      $trainees=Trainee::where('employment_status', 'unemployed')->where('graduated','yes')
      ->whereIn('cohort_id', $cohortIds)->get();
    //   dd($trainees->get());

      return view('employer.showEmployer', ['trainees' => $trainees]);
    }



    public function submitFilters(Request $request)
    {
      $cohortIds = Cohort::where('cohort_status', 1)->pluck('id');
      // dd($cohortIds);
      $query=Trainee::where('employment_status', 'unemployed')
      ->whereIn('cohort_id', $cohortIds);
      $query_result=$query->get();
      // dd($query_result->count());
      // dd($query_result);

    // Apply additional filters
    if ($request->filled('IT')) {
        $query->where('educational_background', $request->IT);
    }

    // Filter by stacks
    $stacks = array_filter([
        Str::replace('_', ' ', $request->get('Mern_Stack')),
        Str::replace('_', ' ', $request->get('asp_net')),
        $request->get('laravel'),
    ]);

    if (!empty($stacks)) {
        $query->whereIn('stack', $stacks);
    }

    // Filter by Nationality
    $nationality = array_filter([
        $request->get('Jordanian'),
        $request->get('Non-Jordanian'),
    ]);

    if (!empty($nationality)) {
        $query->whereIn('nationality', $nationality);
    }

    // Execute the query to get the results and total count

    //   // Filter by gender
    $gender= array_filter([
      $request->get('Female'),
      $request->get('Male'),
    ]);
    // dd($gender);
    if (!empty($gender)) {
      $query->whereIn('gender', $gender);
    }

    // Filter by major
    $field= array_filter([
      Str::replace('_', ' ',  $request->get('Computer_Science')),
      Str::replace('_', ' ',   $request->get('Software_Engineering')),
      // $request->get('other'),
    ]);
    // dd($field);
    if (!empty($field)) {
      $query->whereIn('field', $field);
    }
    // dd($query);
  $trainees = $query->get();
    $trainees = $query->get();  // Get the results
    $totalCount = $trainees->count();  // Get the total count
    // Debugging: Show the results and total count
    // dd([
    //     'results' => $trainees,
    //     'total_count' => $totalCount
    // ]);
    $cities = array_filter([
      $request->get('Amman') ? 'Amman' : null,
      $request->get('Irbid') ? 'Irbid' : null,
      $request->get('Aqaba') ? 'Aqaba' : null,
      $request->get('Zarqa') ? 'Zarqa' : null,
      $request->get('Balqa') ? 'Balqa' : null,
  ]);

  if (!empty($cities)) {
      $query->whereIn('city', $cities);
  }

  // Execute the query to get the results and total count
   $trainees = $query->paginate(20)->appends($request->all()); // Get the results
  // $totalCount = $trainees->count();
// // dd($query);
// $trainees = $query->get();
// $trainees = $query->paginate(20);
//  dd($trainees);
        return view('employer.showEmployer_filtter', compact('trainees'));
    }

    public function emplogout (Request $request){
        Auth::guard('employer')->logout();
        return redirect()->route('empLogin');
    }
}
