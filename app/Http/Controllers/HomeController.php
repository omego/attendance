<?php

namespace App\Http\Controllers;
use App\Block;
use App\AttendanceSheet;
use Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blocks = Block::all();
        $user = Auth::user();
        $UserAttendance = AttendanceSheet::where('user_id', '=', $user->id)->get();;
        $test = "la la land";
        return view('home',compact('blocks', 'user', 'UserAttendance'));
    }
}
