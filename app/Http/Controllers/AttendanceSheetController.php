<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceSheetRequest;
use App\AttendanceSheet;

class AttendanceSheetController extends Controller
{
    public function index()
    {
        $attendancesheets = AttendanceSheet::latest()->get();

        return response()->json($attendancesheets);
    }

    public function store(AttendanceSheetRequest $request)
    {
        $attendancesheet = AttendanceSheet::create($request->all());

        return redirect('home')->with('success', 'Attendance has been taken');

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