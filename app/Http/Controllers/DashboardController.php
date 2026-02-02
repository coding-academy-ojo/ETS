<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Cohort;
use App\Models\Academy;
use App\Models\Company;
use App\Models\Trainee;
use App\Models\Employer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Displays the job coach dashboard with overall employment data for each academy.
     */
    public function jobcoachDashboard()
{
    // Initialize variables
    $employmentData = [];
    $academies = Academy::all();
    $totalCompanies = Company::count();
    $data = [];
    $hasData = false;
    $overall_academy_Trainee=Trainee::get()->count();
    // dd($overall_academy_Trainee);
    // Loop through each academy to calculate employment statistics
  foreach ($academies as $academy) {
    $totalTrainees = Trainee::where('academy_id', $academy->id)->count();
    $totalGraduates = Trainee::where('academy_id', $academy->id)->where('graduated', 'yes')->count();
    $employedTrainees = Trainee::where('academy_id', $academy->id)
        ->where('employment_status', 'employed')
        ->where('graduated', 'yes')
        ->count();
    $availableTrainees = Trainee::where('academy_id', $academy->id)
        ->where('employment_status', 'unemployed')
        ->where('graduated', 'yes')
        ->count();

    // Male/Female breakdown for counts
    $maleFemaleStats = [
        'totalTrainees' => [
            'male' => Trainee::where('academy_id', $academy->id)->where('gender', 'male')->count(),
            'female' => Trainee::where('academy_id', $academy->id)->where('gender', 'female')->count(),
        ],
        'totalGraduates' => [
            'male' => Trainee::where('academy_id', $academy->id)->where('graduated', 'yes')->where('gender', 'male')->count(),
            'female' => Trainee::where('academy_id', $academy->id)->where('graduated', 'yes')->where('gender', 'female')->count(),
        ],
        'availableTrainees' => [
            'male' => Trainee::where('academy_id', $academy->id)->where('employment_status', 'unemployed')->where('graduated', 'yes')->where('gender', 'male')->count(),
            'female' => Trainee::where('academy_id', $academy->id)->where('employment_status', 'unemployed')->where('graduated', 'yes')->where('gender', 'female')->count(),
        ],
        'employedTrainees' => [
            'male' => Trainee::where('academy_id', $academy->id)->where('employment_status', 'employed')->where('graduated', 'yes')->where('gender', 'male')->count(),
            'female' => Trainee::where('academy_id', $academy->id)->where('employment_status', 'employed')->where('graduated', 'yes')->where('gender', 'female')->count(),
        ],
    ];

    // Overall employment rate
    $employmentRate = ($totalGraduates > 0) ? round(($employedTrainees / $totalGraduates) * 100, 0) : 0;

    // Employment rate by gender
    $maleEmploymentRate = ($maleFemaleStats['totalGraduates']['male'] > 0)
        ? ceil(($maleFemaleStats['employedTrainees']['male'] / $totalGraduates) * 100)
        : 0;

    $femaleEmploymentRate = ($maleFemaleStats['totalGraduates']['female'] > 0)
        ? ceil(($maleFemaleStats['employedTrainees']['female'] / $totalGraduates) * 100)
        : 0;

    $employmentData[] = [
        'academy' => $academy->name,
        'totalTrainees' => $totalTrainees,
        'totalGraduates' => $totalGraduates,
        'availableTrainees' => $availableTrainees,
        'employedTrainees' => $employedTrainees,
        'employmentRate' => $employmentRate,
        'maleFemaleStats' => $maleFemaleStats, // only for counts
        'maleEmploymentRate' => $maleEmploymentRate, // only for final column
        'femaleEmploymentRate' => $femaleEmploymentRate, // only for final column
    ];
}



    // Map labels data
    $dynamicLabels = [];
    $labelData = [
        ['name' => 'Amman', 'parent_id' => 'JOR851', 'x' => 299.9, 'y' => 494.28, 'color' => '#fff'],
        ['name' => 'Irbid', 'parent_id' => 'JOR854', 'x' => 193.6, 'y' => 222.8, 'color' => '#fff'],
        ['name' => 'Zarqa', 'parent_id' => 'JOR860', 'x' => 485.9, 'y' => 454.2, 'color' => '#fff'],
        ['name' => 'Aqaba', 'parent_id' => 'JOR849', 'x' => 87.6, 'y' => 1016.9, 'color' => '#fff'],
        ['name' => 'Balqa', 'parent_id' => 'JOR857', 'x' => 166.6, 'y' => 368.1, 'color' => '#fff'],
        ['name' => 'Data ', 'parent_id' => 'JOR857', 'x' => 176.6, 'y' => 400.1, 'color' => '#fff'],
    ];

    foreach ($employmentData as $index => $rate) {
        if (isset($labelData[$index])) {
            $labelData[$index]['rate'] = $rate['employmentRate'];
        }
    }

    foreach ($labelData as $index => $data) {
        $dynamicLabels[] = [
            'id' => $index,
            'name' => $data['name'] . ' ' . ($data['rate'] ?? 0) . '%',
            'parent_id' => $data['parent_id'],
            'x' => $data['x'],
            'y' => $data['y'],
            'color' => $data['color'],
        ];
    }

    // Overall employment rate
    $totalTrainees = Trainee::count();
    $totalEmployed = Trainee::where('employment_status', 'employed')->count();
    $overallEmploymentRate = ($totalTrainees > 0)
        ? round(($totalEmployed / $totalTrainees) * 100, 0)
        : 0;

    $totalAvailable = Trainee::where('employment_status', 'unemployed')->where('graduated', 'yes')->count();
    $companies = Company::count();
    $chartData = $dynamicLabels;

    // Fund + Cohort breakdown
    $funds = Fund::with('cohorts.trainees')->get();
  $fundData = [];

foreach ($funds as $fund) {

    // Base query: all trainees for this fund
    $traineesQuery = \App\Models\Trainee::query()
        ->join('cohorts', 'trainees.cohort_id', '=', 'cohorts.id')
        ->where('cohorts.fund_id', $fund->id);

    // Total counts
    $totalTrainees = $traineesQuery->count();
    $male = (clone $traineesQuery)->where('gender', 'male')->count();
    $female = (clone $traineesQuery)->where('gender', 'female')->count();
    $totalGraduates = (clone $traineesQuery)->whereRaw("LOWER(graduated) = 'yes'")->count();
    $maleGraduates = (clone $traineesQuery)->where('gender', 'male')->whereRaw("LOWER(graduated) = 'yes'")->count();
    $femaleGraduates = (clone $traineesQuery)->where('gender', 'female')->whereRaw("LOWER(graduated) = 'yes'")->count();
    $employed = (clone $traineesQuery)->where('employment_status', 'employed')->whereRaw("LOWER(graduated) = 'yes'")->count();
    $maleEmployed = (clone $traineesQuery)->where('gender', 'male')->where('employment_status', 'employed')->whereRaw("LOWER(graduated) = 'yes'")->count();
    $femaleEmployed = (clone $traineesQuery)->where('gender', 'female')->where('employment_status', 'employed')->whereRaw("LOWER(graduated) = 'yes'")->count();
    $available = (clone $traineesQuery)->where('employment_status', 'unemployed')->whereRaw("LOWER(graduated) = 'yes'")->count();
    $maleAvailable = (clone $traineesQuery)->where('gender', 'male')->where('employment_status', 'unemployed')->whereRaw("LOWER(graduated) = 'yes'")->count();
    $femaleAvailable = (clone $traineesQuery)->where('gender', 'female')->where('employment_status', 'unemployed')->whereRaw("LOWER(graduated) = 'yes'")->count();

    // Base fund entry
    $fundEntry = [
        'fund_name' => $fund->fund_name,
        'totalTrainees' => $totalTrainees,
        'male' => $male,
        'female' => $female,
        'totalGraduates' => $totalGraduates,
        'maleGraduates' => $maleGraduates,
        'femaleGraduates' => $femaleGraduates,
        'employedTrainees' => $employed,
        'maleEmployed' => $maleEmployed,
        'femaleEmployed' => $femaleEmployed,
        'availableTrainees' => $available,
        'maleAvailable' => $maleAvailable,
        'femaleAvailable' => $femaleAvailable,
        'employmentRate' => $totalGraduates > 0 ? round(($employed / $totalGraduates) * 100, 0) : 0,
        'maleEmploymentRate' => $maleGraduates > 0 ? round(($maleEmployed / $totalGraduates) * 100, 0) : 0,
        'femaleEmploymentRate' => $femaleGraduates > 0 ? round(($femaleEmployed / $totalGraduates) * 100, 0) : 0,
    ];

    // EU fund split
    if ($fund->id == 2) {
        $euOCAQuery = (clone $traineesQuery)->whereHas('cohort', fn($q) => $q->where('name', 'NOT LIKE', '%Data Science%'));
        $euDSQuery = (clone $traineesQuery)->whereHas('cohort', fn($q) => $q->where('name', 'LIKE', '%Data Science%'));

        $calculateSplitStats = fn($query) => [
            'totalTrainees' => $query->count(),
            'male' => (clone $query)->where('gender', 'male')->count(),
            'female' => (clone $query)->where('gender', 'female')->count(),
            'totalGraduates' => (clone $query)->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'maleGraduates' => (clone $query)->where('gender', 'male')->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'femaleGraduates' => (clone $query)->where('gender', 'female')->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'employedTrainees' => (clone $query)->where('employment_status', 'employed')->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'maleEmployed' => (clone $query)->where('gender', 'male')->where('employment_status', 'employed')->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'femaleEmployed' => (clone $query)->where('gender', 'female')->where('employment_status', 'employed')->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'availableTrainees' => (clone $query)->where('employment_status', 'unemployed')->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'maleAvailable' => (clone $query)->where('gender', 'male')->where('employment_status', 'unemployed')->whereRaw("LOWER(graduated) = 'yes'")->count(),
            'femaleAvailable' => (clone $query)->where('gender', 'female')->where('employment_status', 'unemployed')->whereRaw("LOWER(graduated) = 'yes'")->count(),
        ];

        $fundEntry['eu_oca'] = $calculateSplitStats($euOCAQuery);
        $fundEntry['eu_oca']['employmentRate'] = $fundEntry['eu_oca']['totalGraduates'] > 0
            ? round(($fundEntry['eu_oca']['employedTrainees'] / $fundEntry['eu_oca']['totalGraduates']) * 100, 0) : 0;
        $fundEntry['eu_oca']['maleEmploymentRate'] = $fundEntry['eu_oca']['maleGraduates'] > 0
            ? round(($fundEntry['eu_oca']['maleEmployed'] / $fundEntry['eu_oca']['maleGraduates']) * 100, 0) : 0;
        $fundEntry['eu_oca']['femaleEmploymentRate'] = $fundEntry['eu_oca']['femaleGraduates'] > 0
            ? round(($fundEntry['eu_oca']['femaleEmployed'] / $fundEntry['eu_oca']['femaleGraduates']) * 100, 0) : 0;

        $fundEntry['eu_ds'] = $calculateSplitStats($euDSQuery);
        $fundEntry['eu_ds']['employmentRate'] = $fundEntry['eu_ds']['totalGraduates'] > 0
            ? round(($fundEntry['eu_ds']['employedTrainees'] / $fundEntry['eu_ds']['totalGraduates']) * 100, 0) : 0;
        $fundEntry['eu_ds']['maleEmploymentRate'] = $fundEntry['eu_ds']['maleGraduates'] > 0
            ? round(($fundEntry['eu_ds']['maleEmployed'] / $fundEntry['eu_ds']['maleGraduates']) * 100, 0) : 0;
        $fundEntry['eu_ds']['femaleEmploymentRate'] = $fundEntry['eu_ds']['femaleGraduates'] > 0
            ? round(($fundEntry['eu_ds']['femaleEmployed'] / $fundEntry['eu_ds']['femaleGraduates']) * 100, 0) : 0;
    }

    $fundData[] = $fundEntry;
}











    return view('admin.dashboard.jobcoach', compact(
        'totalCompanies',
        'fundData',
        'chartData',
        'overallEmploymentRate',
        'totalTrainees',
        'totalAvailable',
        'companies',
        'employmentData',
        'dynamicLabels',
        'academies',
        'overall_academy_Trainee'
    ));
}


    /**
     * Displays the dashboard for a specific
     *
     *
     *
     *
     *  with cohort-based employment data.
     */
    public function academyDashboard(Academy $academy)
    {
        // Retrieve cohorts and their trainees for the specified academy
        $cohorts = Cohort::where('academy_id', $academy->id)
            ->with(['trainees' => function ($query) use ($academy) {
                $query->where('academy_id', $academy->id);
            }])
            ->get();

        $cohortsData = [];
        $totalEmployed = 0;
        $totalTrainees = 0;
        //$cohort = Cohort::find(4);
       /// dd($cohort->trainees->where('employment_status', 'employed')->where('graduated', 'yes')->count());

        // Loop through each cohort to calculate employment statistics
        foreach ($cohorts as $cohort) {
            $totalTraineesCohort = $cohort->trainees->count();
            $totalGraduatesCohort = $cohort->trainees->whereIn('graduated', ['yes','Yes'])->count();
            //dd($totalGraduatesCohort);
            $totalFemale = $cohort->trainees->where('gender','Female')->count();
            $totalMale = $cohort->trainees->where('gender','Male')->count();
            //dd($totalFemale, $totalMale);
            // Calculate employment rate for the cohort
            $employmentRate = $totalGraduatesCohort > 0
                ? round(($cohort->trainees->where('employment_status', 'employed')->whereIn('graduated', ['yes','Yes'])->count() / $totalGraduatesCohort) * 100, 0)
                : 0;
            $totalEmployed += $cohort->trainees->where('employment_status', 'employed')->whereIn('graduated', ['yes','Yes'])->count();
            $totalTrainees += $totalTraineesCohort;

            // Store cohort employment data
            $cohortsData[] = [
                'cohort_id' => $cohort->id,
                'cohort' => $cohort->name,
                'cohort_slug' => $cohort->slug,
                'employedTrainees' => $cohort->trainees->where('employment_status', 'employed')->whereIn('graduated', ['yes','Yes'])->count(),
                'employmentRate' => $employmentRate,
                'totalGraduates' => $totalGraduatesCohort,
                'totalAvailable' => $cohort->trainees->where('employment_status', 'unemployed')->whereIn('graduated', ['yes','Yes'])->count(),
                'totalTrainees' => $totalTraineesCohort,
                'totalFemale' => $totalFemale,
                'totalMale' => $totalMale,
            ];

        }

       // dd($cohortsData);

        // Calculate overall employment rate and completion rate for the academy
        $totalGraduates = Trainee::where('academy_id', $academy->id)->whereIn('graduated', ['yes','Yes'])->count();
        $totalEmployed = Trainee::where('academy_id', $academy->id)->where('employment_status', 'employed')->where('graduated', 'yes')->count();
       // dd($totalEmployed, $totalGraduates, $totalTrainees);
        $overallEmploymentRate = $totalTrainees > 0
            ? round(($totalEmployed / $totalGraduates * 100), 0)
            : 0;


        $completionRate = $totalTrainees > 0
            ? round((Trainee::where('academy_id', $academy->id)->whereIn('graduated', ['yes','Yes'])->count() / $totalTrainees) * 100, 0)
            : 0;

        $availableTrainees = Trainee::where('academy_id', $academy->id)->where('employment_status', 'unemployed')->where('graduated', 'yes')->count();
        // Return view with the calculated cohort data



        return view('admin.dashboard.academy', compact('academy', 'cohortsData', 'overallEmploymentRate', 'totalTrainees', 'availableTrainees', 'completionRate','cohorts'));
    }



    public function showLineChart()
    {
        $cohorts = Cohort::select('name', 'cohort_Rate')->get();
        return view('line-chart', compact('cohorts'));
    }
}
