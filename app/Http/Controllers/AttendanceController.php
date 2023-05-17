<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use DateTime;

class AttendanceController extends Controller
{
    public function index() {
        $attendance = Attendance::with('employee')->get();
        return response()->json($attendance);
    }

    public function importAttendance(Request $request) {
        $data = $request->all();

        foreach($data as $record) {
            // return $record;
            $employee = Employee::find($record['EMPLOYEE_ID']);

            //Its a temrory code just to avoid datetime error 
            //Issue with the csv/xls file date column
            $date = new DateTime();
            $checkin = $date->setTimestamp($record['CHECKIN']);
            $checkout = $date->setTimestamp($record['CHECKOUT']);
            
            $attendance = $employee->attendances()->create([
                'checkin' => $checkin,
                'checkout' => $checkout,
                'schedule_id' => $record['SCHEDULE_ID']
            ]);
        }

        $attendance = Attendance::with('employee')->get();
        return response()->json($attendance);
    }


    //Challenge 2 and 4
    function findDuplicateElements($arr) {
        $duplicateElements = "";
    
        for($i=0; $i<sizeof($arr); $i++) {
            for($j=$i+1; $j<sizeof($arr); $j++) {
                if($arr[$i] == $arr[$j]) {
                  $duplicateElements .=  $arr[$i] . " ";
                }
            }
        }
        return $duplicateElements;
    }
    
    function groupByOwnersService($arr) {
        $group = [];
    
        foreach($arr as $file => $owner) {
            if(isset($group[$owner])) {
                $group[$owner][] = $file;
            } else {
                $group[$owner] = [$file];
            }
        }
    }
}
