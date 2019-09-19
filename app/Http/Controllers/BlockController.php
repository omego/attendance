<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockRequest;
use App\Block;
use App\User;
use DB;
use App\blockStudents;
use Auth;

class BlockController extends Controller
{
  public function index()
  {
    $blocks = Block::latest()->get();
    $user = Auth::user();

    // return response()->json($blocks);
    return view('blocks.index', compact('blocks'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
    return view('blocks.create');
  }

  public function store(BlockRequest $request)
  {
    // $block = Block::create($request->all());

    $request->validate([
      'block_title'=>'required',
    ]);
    $block = new block;

    $block->block_title = $request->block_title;

    $block->save();
    return redirect('/blocks')->with('success', 'Block has been added');

    // return response()->json($block, 201);
  }

  public function show($id)
  {
    $block = Block::findOrFail($id);

    return response()->json($block);
  }

  public function update(BlockRequest $request, $id)
  {
    $block = Block::findOrFail($id);

    $block->block_title = $request->block_title;
    $block->save();

    $students = $request->assignStuToBlock; // array of Students to be assigned to the block

    foreach ($students as $student) {
      $data = array('user_id' =>$student , 'block_id' => $id, 'created_at' => \Carbon\Carbon::now());
      blockStudents::insert($data);
    }

    return redirect('/blocks')->with('success', 'Block has been updated');


  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Block  $block
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    $block = Block::findOrFail($id);

    $batches = User::whereNotNull('batch')->select('batch')->distinct()->get();

    return view('blocks.edit', compact('block','batches'));
  }

  public function dynamic_dependent($id,$bid)
  {

    // All students in selected batch
    $stuList = User::where('batch','=',$id)->get();

    $assigned_stu = blockStudents::where('block_id','=',$bid)->get();

    // if the block has students already assigned to it
    if ($assigned_stu){

      $assigned_list = DB::table("block_user")
      ->where("block_id",$bid)
      ->join('users', 'users.id', '=', 'block_user.user_id')
      ->select('users.id')->get();

      foreach($stuList as $k => $obj) {
        $obj->{'assigned'} = 0;
      }

      $assigned_list = json_decode($assigned_list, true);

      // compare assigned students to all students
      foreach ($stuList as $key1=>$value1) {
        foreach ($assigned_list as $key2=>$value2) {
          if ($value1['id']== $value2['id']) {
            $value1['assigned']=1;
          }
        }
      }

      return $stuList;
    }
    else{
      return $stuList;
    }

  }

  public function destroy($id)
  {
    Block::destroy($id);

    return response()->json(null, 204);
  }
}
