<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockRequest;
use App\Block;
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
        // $block->update($request->all());
        //
        // return response()->json($block, 200);
        $block->block_title = $request->block_title;


        $block->save();
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
        return view('blocks.edit', compact('block'));
    }

    public function destroy($id)
    {
        Block::destroy($id);

        return response()->json(null, 204);
    }
}
