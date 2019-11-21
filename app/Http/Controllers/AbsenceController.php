<?php

namespace App\Http\Controllers;

use App\AttendanceSheet;
use App\Http\Requests\AbsenceSheetRequest;
use App\Block;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;

class AbsenceController extends Controller
{
    public function index()
    {
      $blocks = Block::all();
      $batches = User::select('batch')
                ->where('batch' , '!=', 'null')
                ->distinct()
                ->orderBy('batch', 'ASC')
                ->get();
      return view('absence.calculator',compact('blocks','batches'));
    }

    public function absenceSheet(AbsenceSheetRequest $request)
    {

      $request->validate([
        'sessions_count'=>'required',
        'block_id'=>'required',
        'batch_number'=>'required',
        'date'=>'required'
      ]);

      $sessions_count = $request->sessions_count;
      $block_id = $request->block_id;
      $batch_number = $request->batch_number;
      $date = $request->date;

      $block = Block::findOrFail($block_id);

      $all_batch_stu = User::select('id')
                      ->where('batch','=',$batch_number)
                      ->pluck('id')->toArray();

      /* Today Absence */
      $todayAttendance = AttendanceSheet::select('user_id', DB::raw('count(*) as total'))
                        ->whereDate('created_at', $date)
                        ->where('block_id', '=', $block_id)
                        ->whereIn('user_id', $all_batch_stu)
                        ->groupBy('user_id')
                        ->having('total','=',$sessions_count)
                        ->pluck('user_id')->toArray();


      $todayAbsence = array_diff($all_batch_stu, $todayAttendance);

      $absentList = User::select('*')->whereIn('id', $todayAbsence)->get();

      foreach ($absentList as $key => $value) {
        $value->{'count'} = '';
        $value->{'sessions'} = '';
      }

      foreach ($absentList as $key => $value) {
        $count = AttendanceSheet::select('user_id')
                ->whereDate('created_at', $date)
                ->where('block_id', '=', $block_id)
                ->where('user_id', '=', $value->id)
                ->whereIn('user_id', $all_batch_stu)
                ->count();

      $sessions = AttendanceSheet::select(DB::raw('TIME(created_at) as time'))
              ->whereDate('created_at', $date)
              ->where('block_id', '=', $block_id)
              ->where('user_id', '=', $value->id)
              ->whereIn('user_id', $all_batch_stu)
              ->get();

        if ($count > 0){
          $value['count']=$count;
          $value['sessions']=$sessions;
        }
        else{
          $value['count']=0;
          $value['sessions']=0;
        }
      }

      return view('absence.index', compact('batch_number','sessions_count','block','absentList'));
    }
}
