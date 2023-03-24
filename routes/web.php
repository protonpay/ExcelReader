<?php

use App\Models\Designation;
use App\Models\EmployeeExitFormInput;
use App\Models\EmployeeRolesDesignation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\EmployeeOnboardingFormInput;
use App\Models\EmployeeResignationReason;
use App\Models\EmployeeAccess;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
|  RoutWebes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('designation', function () {

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load('file.xlsx');
    $sheetData = $spreadsheet->setActiveSheetIndexByName('Emp Onboard')->toArray();
    $designations = array();
    for ($i = 1; $i < count($sheetData); $i++) {
        $designation = $sheetData[$i][2];
        array_push($designations, $designation);
    }

    $Unique = array_unique(array_filter($designations));

    print_r($Unique);
    // $dataToInsert = [];
    // foreach ($Unique as $data) {
    //     array_push($dataToInsert, ['roles_and_designation' => $data]);
    // }
    // EmployeeRolesDesignation::insert($dataToInsert);

    // return "<h1 style = text-align:center> Data Inserted Successfully!!..</h1>";
});

// Employee On boarding insert

Route::get('employee-onboard', function () {

    // Load the XLSX file into a PhpSpreadsheet object
    $spreadsheet = IOFactory::load('file.xlsx');

    // Get the active sheet
    $worksheet = $spreadsheet->getActiveSheet();

    //get all rows

    $shetRows = $worksheet->toArray();
    foreach ($shetRows as $row) {

        // Log::info($row);
        $formInput = new EmployeeOnboardingFormInput();
        $formInput->employee_name = $row[0];
        $formInput->employee_id = $row[1];
        $formInput->roles_responsible_id = EmployeeRolesDesignation::where('roles_and_designation', $row[2])->first()->id;
        $formInput->assigned_to_client_id = $row[3];
        $formInput->date_of_joining = DateTime::createFromFormat('d/M/y', $row[4]);
        $formInput->contract_start = $row[5];
        $formInput->contract_end = $row[6];
        $formInput->bgv_completed = $row[7];
        $formInput->save();
        // dd($formInput);
    }
    return "<h1 style = text-align:center> Data Inserted Successfully!!..</h1>";
});

// employee Exit Insert 


Route::get('employee-exit', function () {

    // Load the XLSX file into a PhpSpreadsheet object
    $spreadsheet = IOFactory::load('file.xlsx');

    // Get the active sheet
    $worksheet = $spreadsheet->getSheetByName('Emp Exit');

    //get all rows

    $shetRows = $worksheet->toArray();
    //remove first two rows
    array_shift($shetRows);
    array_shift($shetRows);

    foreach ($shetRows as $row) {
        // 
        Log::info($row);
        $formInput = new EmployeeExitFormInput();
        $formInput->employee_name = $row[0];
        $formInput->employee_id = $row[1];
        $formInput->resignation_date = DateTime::createFromFormat('d/M/y', $row[2]);
        $formInput->separation_date = DateTime::createFromFormat('d/M/y', $row[3]);
        $formInput->reason_for_resignation = EmployeeResignationReason::where('reason', $row[4])->first()->id;

        $revokedAccess = [
            [
                'access_id' => 2,
                'revoked_date' => null,
                'detail' => $row[5]
            ],
            [
                'access_id' => 6,
                'revoked_date' => isDate($row[9]) ? DateTime::createFromFormat('d/M/y', $row[9]) : null,
                'detail' => !isDate($row[9]) ? $row[9] : null,

            ]

        ];
        $formInput->revoked_accesses = json_encode($revokedAccess);
        $clearences=[];
        Log::info($row[13]);
        if($row[13]==1){
            array_push($clearences,3);
            // dd($formInput);
        }
        $formInput->clearance_received = json_encode($clearences);
        $formInput->added_time = Carbon::now();
        $formInput->save();
        

    }
});




function isDate($value)
{
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

