<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockRequest;
use App\Block;
use App\User;
use App\Group;
use DB;
use App\UserBlock;
use Auth;

class BlockController extends Controller
{
  public function index()
  {
    //$blocks = Block::latest()->get();
    $blocks = DB::table("blocks")
    ->leftjoin('block_user', 'blocks.id', '=', 'block_user.block_id')
    ->leftjoin('users', 'users.id', '=', 'block_user.user_id')
    ->select('blocks.id as id','blocks.block_title as block_title','users.batch as batch')
    ->orderBy('blocks.id')
    ->groupBy('blocks.id')
    ->get();

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

    if ($students){ // if at least one students selected (checked)
      // delete all old assignment
      UserBlock::where('block_id', $id)->delete();
      $result = false;
      foreach ($students as $student) {
        $data = array('user_id' =>$student , 'block_id' => $id, 'created_at' => \Carbon\Carbon::now());
        $result = UserBlock::insert($data);
      }

      if ($result)
      {
        return redirect('/blocks')->with('success', 'Block has been updated');
      }
    }
    else { // if no students selected
      return redirect('/blocks');
    }

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

    $assigned_stu = UserBlock::where('block_id','=',$bid)->get();

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

  public function block_clear ($id){

    $result = UserBlock::where('block_id', $id)->delete();
    if ($result){
      return redirect('/blocks')->with('success', 'Block has been cleared');
    }
    else {
      return redirect('/blocks')->with('warning', 'Something wrong happened, please try again');
    }


  }

  public function destroy($id)
  {
    Block::destroy($id);

    return response()->json(null, 204);
  }
}
