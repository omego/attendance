<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Block;
use App\UserBlock;
use App\User;
use Validator;


class BlockController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = Block::all();
        // return response()->json($blocks);

        // return $this->sendResponse($blocks->toArray(), 'Products retrieved successfully.');
        return response()->json($blocks);
    }

    public function create(Request $request)
    {
        //
        $block = new block;

        $block->block_title = $request->block_title;


        $block->save();

        return $this->sendResponse($block->toArray(), 'Block created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);


        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }


        $block = Block::create($input);


        return $this->sendResponse($block->toArray(), 'block created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $block = Block::find($id);


        if (is_null($block)) {
            return $this->sendError('Product not found.');
        }


        return $this->sendResponse($block->toArray(), 'Product retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();


        return $this->sendResponse($product->toArray(), 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();


        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
    }

    public function userBlockName(Request $request)
    {
        $getUserId = User::where('email', $request->userEmail)->first(); //get the user id by his email from the request
        if ($getUserId){
            $userBlockId = UserBlock::where('user_id', $getUserId->id)->value('block_id');
            $userBlock = $getUserId->blocks()->first();
            if (is_null($userBlock)) {
                return response(null, 204);
            }
            elseif ($userBlock){
                return response()->json($userBlock);
            }
        }else{
            return response(null, 404);
        }
        // $userBlockId = UserBlock::where('user_id', $getUserId->id)->value('block_id');
        // // $userBlockName = Block::where('id', $userBlockId)->value('block_title');
        // $userBlock = $getUserId->blocks()->first();
        // dump($userBlock->block_title);
        // echo($getUserId->blocks()->first());
        // echo($userBlock);
        // return $this->sendResponse($userBlockName->toArray(), 'block created successfully.');
        // if (is_null($userBlock)) {
        //     return response(null, 204);
        // }
        // elseif (isset($userBlock)){
        //     return response(null, 404);
        // }
        // elseif ($userBlock){
        //     return response()->json($userBlock);
        // }
        // elseif (!$userBlock){
        //     return response()->json($userBlock);
        // }
        
    }

}