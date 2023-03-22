<?php

use App\Models\Designation;
use App\Models\EmployeeRolesDesignation;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

Route::get('render', function () {

    // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    // $spreadsheet = $reader->load('file.xlsx');
    // $sheetData = $spreadsheet->setActiveSheetIndexByName('Emp Onboard')->toArray();
    // $designations = array();
    // for ($i = 1; $i < count($sheetData); $i++) {
    //     $designation = $sheetData[$i][2];
    //     array_push($designations, $designation);
    // }

    // $Unique = array_unique(array_filter($designations));


    // $dataToInsert = [];
    // foreach ($Unique as $data) {
    //     array_push($dataToInsert, ['roles_and_designation' => $data]);
    // }
    // EmployeeRolesDesignation::insert($dataToInsert);

    // return "<h1 style = text-align:center> Data Inserted Successfully!!..</h1>";
});

Route::get('render', function () {

// Load the XLSX file into a PhpSpreadsheet object
$spreadsheet = IOFactory::load('file.xlsx');

// Get the active sheet
$worksheet = $spreadsheet->getActiveSheet();

// Set the row number to print
$rowNumber = 100;
// Get the row iterator for the worksheet
$rowIterator = $worksheet->getRowIterator();

// Loop through the rows until you find the row to print
foreach ($rowIterator as $row) {
    if ($row->getRowIndex() == $rowNumber) {
        // Get the cell iterator for the row
        $cellIterator = $row->getCellIterator();
        $row='';
        // Loop through the cells in the row and print their values
        foreach ($cellIterator as $cell) {
            $row.=$cell->getValue() . ',';

        }
        echo $row;
    }
}
});

// Load the XLSX file into a PhpSpreadsheet object
// $spreadsheet = IOFactory::load('file.xlsx');

// // Get the active sheet
// $worksheet = $spreadsheet->getActiveSheet();

// // Get the highest row number
// $highestRow = $worksheet->getHighestRow();

// // Loop through all rows and print their cell values
// for ($row = 1; $row = $highestRow; $row++) {
//     $cellIterator = $worksheet->getRowIterator($row)->current()->getCellIterator();
//     $cellValue = $worksheet->getCell('B2');
//     foreach ($cellValue as $cell) {

//                 echo $cell;
//             }
//         // echo $cellValue;
//         echo "<br>";
//         echo "\n";
//     }
// });





