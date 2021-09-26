<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\AttendanceSheet;
use App\Block;
use Validator;
use App\User;
use Carbon\Carbon;


class AttendanceSheetController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendancesheets = AttendanceSheet::all();

        return response()->json($attendancesheets);

        // return $this->sendResponse($attendancesheets->toArray(), 'Prcts retrieved successfully.');
    }

    public function create(Request $request)
    {
        //
        $attendancesheets = new AttendanceSheet;

        $attendancesheets->user_id = $request->user_id;


        $attendancesheets->save();

        return $this->sendResponse($attendancesheets->toArray(), 'Block created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();


        // $validator = Validator::make($input, [
        //     'name' => 'required',
        //     'detail' => 'required'
        // ]);


        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
        $attendancesheets = new AttendanceSheet;
        
        // $userEmail = User::select('id')->where('email', $request->user_email)->first();
        // $attendancesheets->user_id = $userEmail->id;
        // $attendancesheets->block_id = $request->block_id;
        // $attendancesheets->coords = $request->coords;
        // $attendancesheets->beacon = $request->beacon;

        $user = User::select('id')->where('email', $request->user_email)->first();
        $attendancesheets->user_id = $user->id;
        $userBlockId = $user->blocks()->first();
        $attendancesheets->block_id = $userBlockId->id;
        // $attendancesheets->coords = $request->coords;
        $attendancesheets->beacon = $request->beacon_name;

        // $attendanceSheet = AttendanceSheet::create($input);
        
        $attendancesheets->save();

        // return $this->sendResponse($attendancesheets->toArray(), 'attendance created successfully.');

        return response()->json([
            "message" => "Attendance taken successfully"
        ], 201);
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

    public function StudentLastAttendance($email_id)
    {

        $user = User::select('id')->where('email', $email_id)->first();

        $fromDate = Carbon::parse(Carbon::now()->toFormattedDateString())->startOfDay();
        $toDate = Carbon::parse(Carbon::now()->toFormattedDateString())->endOfDay();
        $UserLastAttendance = AttendanceSheet::where('user_id', '=', $user->id)
        // ->whereBetween('created_at', [$fromDate, $toDate])
        ->get();

        // $attendancesheets = AttendanceSheet::find($id);


        // if (is_null($block)) {
        //     return $this->sendError('Product not found.');
        // }

        // return response()->json($UserLastAttendance);
        // return $this->sendResponse($UserLastAttendance->toArray(), 'Product retrieved successfully.');
        return response()->json($UserLastAttendance);
    }
    public function StudentAttendance($email_id)
    {

        $user = User::select('id')->where('email', $email_id)->first();
        // $UserLastAttendance = AttendanceSheet::where('user_id', '=', $user->id)->latest()
        $UserLastAttendance = AttendanceSheet::with('block')->where('user_id', '=', $user->id)->latest()->get();

        // $attendancesheets = AttendanceSheet::find($id);


        // if (is_null($block)) {
        //     return $this->sendError('Product not found.');
        // }

        // return response()->json($UserLastAttendance);
        // return $this->sendResponse($UserLastAttendance->toArray(), 'Product retrieved successfully.');
        if ($UserLastAttendance->isEmpty()) {
            return response(null, 204);
        }
        
        return response()->json($UserLastAttendance);
    }
}