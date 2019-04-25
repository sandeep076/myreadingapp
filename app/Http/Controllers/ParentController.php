<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\ReadingRecord;
use DB;
use Auth;

class ParentController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\Log::info('Redirected parent!');  //for debugging
        return view('parent_dashboard');
    }

    //Store parent's comments in reading_records db table
    public function update(Request $request){
        $readingrecordid = $request->bookname;
        //find the reading records model
        $record = ReadingRecord::where('recordID', $readingrecordid)
                ->update(['commentDate' => date('Y-m-d'),
                    'comment' => $request->comment]);
    }

}
