<?php

namespace App\Http\Controllers;

use App\AttendanceSheet;
use App\UserBlock;
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
      return view('absence.calculator',compact('blocks'));
    }

    public function absenceSheet(AbsenceSheetRequest $request)
    {

      $request->validate([
        'sessions_count'=>'required',
        'block_id'=>'required'
      ]);

      $sessions_count = $request->sessions_count;
      $block_id = $request->block_id;

      $block = Block::findOrFail($block_id);

      $all_block_stu = UserBlock::select('user_id')
                      ->where('block_id','=',$block_id)->pluck('user_id')->toArray();

      /* Today Absence */
      $todayAttendance = AttendanceSheet::select('user_id', DB::raw('count(*) as total'))
                        ->whereDate('created_at', Carbon::today())
                        ->where('block_id', '=', $block_id)
                        ->groupBy('user_id')
                        ->having('total','=',$sessions_count)
                        ->pluck('user_id')->toArray();


      $todayAbsence = array_diff($all_block_stu, $todayAttendance);

      /*$absentList = DB::table('users')
                  ->select('users.*', DB::raw('count(*) as total'))
                  ->join('attendance_sheets', 'attendance_sheets.user_id', '=', 'users.id')
                  ->whereIn('attendance_sheets.user_id', $todayAbsence)
                  ->whereDate('attendance_sheets.created_at', Carbon::today())
                  ->where('attendance_sheets.block_id', '=', $block_id)
                  ->get();
                  //->paginate(10);*/

      $absentList = User::select('*')->whereIn('id', $todayAbsence)->get();

      foreach ($absentList as $key => $value) {
        $value->{'sessions'} = '';
      }

      foreach ($absentList as $key => $value) {
        $count = AttendanceSheet::select('user_id')
                ->whereDate('created_at', Carbon::today())
                ->where('block_id', '=', $block_id)
                ->where('user_id', '=', $value->id)
                ->count();
        if ($count > 0){
          $value['sessions']=$count;
        }
        else{
          $value['sessions']=0;
        }
      }

      /* End */

      /* Today Partially or All Sessions Absence
      $partiallyAttendance = AttendanceSheet::select('user_id', DB::raw('count(*) as total'))
                        ->whereDate('created_at', Carbon::today())
                        ->where('block_id', '=', $block_id)
                        ->groupBy('user_id')
                        ->having('total','<',$sessions_count)
                        ->pluck('user_id')->toArray();

      $partiallyAbsence = array_diff($all_block_stu, $todayAttendance);

      $partiallyAbsentCount = User::select('*')->whereIn('id', $partiallyAbsence)->count();
      /* End */


      return view('absence.index', compact('sessions_count','block','absentList'));

    }
}
