<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PdfReport;
use CSVReport;
use Carbon\Carbon;

use App\Block;
use App\User;
use App\AttendanceSheet;

class ExportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('exports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



public function downloadExport(Request $request)
{
    // app('debugbar')->disable();
    $fromDate = Carbon::parse($request->input('from_date'))->startOfDay();
    $toDate = Carbon::parse($request->input('to_date'))->endOfDay();
    $sortBy = $request->input('sort_by');
    // $byUser = $request->input('by_User');

    // $users = User::with(['roles' => function($q){
    // $q->where('name', 'admin');
    // }])->get();

    // $dt = Carbon::now();

    $filename = 'attendance_sheet_export_'.Carbon::now()->format('dmy_his');


    $title = 'Test Export'; // Export title

    $meta = [ // For displaying filters description on header
        'Attendance Sheet from' => $fromDate . ' To ' . $toDate,
        'Sort By' => $sortBy
    ];

      $queryBuilder = AttendanceSheet::select(['id', 'block_id', 'created_at', 'user_id']) // Do some querying..
                          ->whereBetween('created_at', [$fromDate, $toDate])
                          ->orderBy($sortBy);


    $columns = [ // Set Column to be displayed
        'ID' => 'id',
        // 'Block' => 'ticket_title',
        // 'Agent' => function($queryBuilder) {
        //     $date = array();
        //     foreach ($queryBuilder->user as $Builder) {
        //         $date[] = $Builder->name;
        //     }
        //     // return json_encode($date);
        //     return implode(', ', $date);
        //   },
        'Student' => function($queryBuilder) {
            return $queryBuilder->user['name'];
          },
        'Block' => function($queryBuilder) {
            return $queryBuilder->block['block_title'];
          },
        'Student #' => function($queryBuilder) {
            return $queryBuilder->user['badge_number'];
          },
        'Badge #' => function($queryBuilder) {
            return $queryBuilder->user['student_number'];
          },
        'created at' => 'created_at'
    ];

    CSVReport::of($title, $meta, $queryBuilder, $columns)
             // ->withoutManipulation()
             ->showNumColumn(false)
             ->download($filename);
           }
}
