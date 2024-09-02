<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function AttendanceData()
    {
        $attendance_data = Attendance::with('user')->orderBy('id','desc')->get();
        // $attendance_data = Attendance::with('user')->orderBy('date','desc')->get();

        return view('attendance.list', compact('attendance_data'));
    }

    public function AttendanceReport(Request $request)
    {
        $attendance_data = Attendance::with('user')->orderBy('date','desc')->get();
        $unique_dates = Attendance::select('date')
                    ->distinct()
                    ->orderBy('date')
                    ->pluck('date');

        $days = $unique_dates->map(function ($date) {
            return Carbon::parse($date)->day;
        })->unique()->sort()->values();


        $employees = User::select('id','name','user_name')->get();

        return view('attendance.report', compact('attendance_data','days','employees'));
    }
}
