<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{
    public function index() {
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
