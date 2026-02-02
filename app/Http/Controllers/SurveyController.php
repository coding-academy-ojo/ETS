<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Academy;
use App\Models\Cohort;
use App\Models\Trainee;


class SurveyController extends Controller
{
    //

    public function show($surveyId)
{
    // Find the survey by its ID
    $surveyLogs = Survey::findOrFail($surveyId);

    // Pass the surveyLogs to the view
    return view('survey.show', compact('surveyLogs'));
}
public function survey1()
{
    $academies = Academy::all();
    $cohorts = Cohort::all();
    // dd($academies);
    // Fetch all academies and cohorts
    return view('Survey.survey1', compact('academies', 'cohorts'));
}
public function survey2()
{
    $trainees = Trainee::all(); 

    return view('Survey.survey2', ['trainees' => $trainees]); 
}
    
    public function survey3() {

        return view('survey3');
    } public function survey4() {

        return view('survey4');
    }
    public function surveyResult($academyId)
    {
        $academies = Academy::all();
        $academy = Academy::find($academyId);
        $cohorts = Cohort::all();

        // Check if the academy exists
        if (!$academy) {
            return redirect()->back()->with('error', 'Academy not found.');
        }

        return view('Survey.result.surveyResult', compact('academies', 'cohorts', 'academy'));
    }
    public function showSurveyDetail($id)
    {
        $survey = Survey::findOrFail($id);

        return view('survey.detail', compact('survey')); 
    
    }
    public function tableSurveyDetails() {
        $surveys = Survey::all();

        return view('Survey/result/tableSurveyDetails', compact('surveys'));
    }
    //amman cohort3
    public function surveyResult3() {

        // return view('Survey/result/ammanSurvey/surveyResultCohort3');
    }
    public function tableSurveyDetails3() {

        return view('Survey/result/academyS/tableSurveyDetailsCohort3');
    }
    // aqaba cohort3
    public function surveyResultAqaba3() {

        return view('Survey/result/aqabaSurvey/surveyResultCohort3');
    }
    public function tableSurveyDetailsAqaba3() {

        return view('Survey/result/aqabaSurvey/tableSurveyDetailsCohort3');
    }


    public function saveSurveyData(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'studentFullName' => 'required|string|max:255',
            'empStatus' => 'required|string|max:255',
            'companyName' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'joiningDate' => 'required|date',
        ]);

        // Create a new Survey model instance
        $survey = new Survey();
        $survey->student_full_name = $validatedData['studentFullName'];
        $survey->employment_status = $validatedData['empStatus'];
        $survey->company_name = $validatedData['companyName'];
        $survey->position = $validatedData['position'];
        $survey->joining_date = $validatedData['joiningDate'];
        $survey->save();

        // Optionally, you can add a success message or redirect to a success page
        return redirect()->route('survey.thankyou')->with('success', 'Survey data saved successfully!');
    }



    public function sendSurvey(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);

        // Retrieve the selected academy and cohort
        $academyId = $validatedData['academy_id'];
        $cohortId = $validatedData['cohort_id'];

        // Fetch all trainees for the selected academy and cohort
        $trainees = Trainee::where('academy_id', $academyId)
            ->where('cohort_id', $cohortId)
            ->get();

        // Iterate through the trainees and send the survey to each one
        foreach ($trainees as $trainee) {
            // Send survey logic
            $surveyData = [
                'trainee_name' => $trainee->name,
                'email' => $trainee->email,
                // Add more data as needed for the survey email
            ];

            // Send email notification
            Mail::to($surveyData['email'])->send(new SurveyNotification($surveyData));
        }

        // Optionally, you can add a success message or redirect
        return redirect()->back()->with('success', 'Survey sent to trainees successfully!');
    }

    public function thankyou()
    {
        return view('survey.thankyou');
    }


    public function sendNotification(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'academy' => 'required|exists:academies,id',
            'cohort' => 'required|exists:cohorts,id',
        ]);

        // Get the selected academy and cohort
        $academyId = $validatedData['academy'];
        $cohortId = $validatedData['cohort'];

        // Get all students belonging to the selected academy and cohort
        $trainees = Trainee::where('academy_id', $academyId)
            ->where('cohort_id', $cohortId)
            ->get();

        // Send email notifications to each student
        foreach ($trainees as $trainee) {
            // Customize your email content here
            $emailContent = "Dear {$trainee->name},\n\nYou have a new survey to complete.";

            // Send email using Laravel Mail
            // Mail::raw($emailContent, function ($message) use ($student) {
            //     $message->to($student->email)->subject('New Survey Notification');
            // });
        }

        // Optionally, you can redirect back with a success message
        return redirect()->back()->with('success', 'Email notifications sent successfully.');
    }


    public function fetchTrainees(Request $request)
{
    $validatedData = $request->validate([
        'academy_id' => 'required|exists:academies,id',
        'cohort_id' => 'required|exists:cohorts,id',
    ]);

    $academyId = $validatedData['academy_id'];
    $cohortId = $validatedData['cohort_id'];

    // Fetch trainees based on the academy and cohort IDs
    $trainees = Trainee::where('academy_id', $academyId)
        ->where('cohort_id', $cohortId)
        ->get();

    return response()->json($trainees);
}





}
