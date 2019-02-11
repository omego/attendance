<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;
use Auth;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $problems = Problem::latest()->paginate(10);
      return view('problem.index', compact('problems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user_id = Auth::user();
        return view('problem.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'problem_title'=>'required',
      ]);
      $problem = new Problem;
      $problem->problem_title = $request->problem_title;
      $problem->problem_content = $request->problem_content;
      $problem->user_id = Auth::user()->id;
      $problem->save();
      return redirect('home')->with('success', 'Problem has been sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(problem $problem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // $problem = Problem::find($id);
      // return view('problem.edit', compact('problem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
      // $problem = Problem::find($id);
      // $problem->problem_title = $request->problem_title;
      // $problem->save();
      //
      // return redirect('/problem')->with('success', 'problem has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       $problem = Problem::findOrfail($id);
       $problem->delete();
       return redirect('/problems')->with('success', 'problem has been deleted');
     }
}
