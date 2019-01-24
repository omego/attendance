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

    public function store(BlockRequest $request)
    {
        $block = Block::create($request->all());

        // $blocks = new Block;
        // $blocks->block_title = $request->block_title;
        // $ticket->ticket_content = $request->ticket_content;
        // $ticket->category_id = $request->category_id;

        return response()->json($block, 201);
    }

    public function show($id)
    {
        $block = Block::findOrFail($id);

        return response()->json($block);
    }

    public function update(BlockRequest $request, $id)
    {
        $block = Block::findOrFail($id);
        $block->update($request->all());

        return response()->json($block, 200);
    }

    public function destroy($id)
    {
        Block::destroy($id);

        return response()->json(null, 204);
    }
}