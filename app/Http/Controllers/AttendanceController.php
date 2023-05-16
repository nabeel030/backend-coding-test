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
}
