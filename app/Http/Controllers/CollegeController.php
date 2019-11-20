<?php

namespace App\Http\Controllers;

use App\College;
// use App\Http\Requests\CollegeRequest;
use Illuminate\Http\Request;


class CollegeController extends Controller
{
  public function index()
  {
   
    $colleges = College::all();
    
    return view('colleges.index', compact('colleges'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
    return view('colleges.create');
  }

  public function store(Request $request)
  {

    $request->validate([
      'name'=>'required',
    ]);
    $college = new college;

    $college->name = $request->name;
    $college->description = $request->description;

    $college->save();

    return redirect('/college')->with('success', 'college has been added');

  }

  public function show($id)
  {
    $colleges = college::findOrFail($id);
   

    return response()->json($colleges);
  }

  public function update(Request $request, $id)
  {
    $college = college::findOrFail($id);

    $college->name = $request->name;
    $college->description = $request->description;
    $college->save();
    return redirect('/college')->with('success', 'college has been updated');
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\college  $college
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    $college = college::findOrFail($id);


    return view('colleges.edit', compact('college'));
  }




  public function destroy($id)
  {

    $college = College::findOrfail($id);
    $college->delete();
    return redirect('/college')->with('success', 'college has been deleted');
  }

}
