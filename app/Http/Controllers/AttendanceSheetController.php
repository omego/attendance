<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceSheetRequest;
use App\AttendanceSheet;
use App\Block;
use Carbon\Carbon;
use Auth;

class AttendanceSheetController extends Controller
{
    public function index()
    {
        $attendancesheets = AttendanceSheet::latest()->simplePaginate(15);

        return view('attendance.index', compact('attendancesheets'));
        // return response()->json($attendancesheets);
    }

    public function store(AttendanceSheetRequest $request)
    {
        $fromDate = Carbon::parse(Carbon::now()->toFormattedDateString())->startOfDay();
        $toDate = Carbon::parse(Carbon::now()->toFormattedDateString())->endOfDay();
        $user = Auth::user();
        $UserAttendance = AttendanceSheet::where('user_id', '=', $user->id)
        ->where('created_at', '>', Carbon::now()->subMinutes(5)->toDateTimeString())
        ->get();

        if ($UserAttendance->isEmpty()) {
            $attendancesheet = AttendanceSheet::create($request->all());
            return redirect('home')->with('success', 'Attendance has been taken');
        }
else {
            # code...
            return redirect('home')->with('danger', 'Attendance has been taken already!');
        }
    }

    public function show($id)
    {
        $attendancesheet = AttendanceSheet::findOrFail($id);

        return response()->json($attendancesheet);
    }

    public function update(AttendanceSheetRequest $request, $id)
    {
        $attendancesheet = AttendanceSheet::findOrFail($id);
        $attendancesheet->update($request->all());

        return response()->json($attendancesheet, 200);
    }

    public function destroy($id)
    {
        AttendanceSheet::destroy($id);

        return response()->json(null, 204);
    }
}
