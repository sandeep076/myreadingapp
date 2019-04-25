<?php

namespace App\Http\Controllers;

use App\Book;
use App\ReadingRecord;
use App\GuidedSession;
use App\Pupil;


use App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //\Log::info('Redirected teacher!');  //for debugging
        return view('teacher_dashboard');
    }

    /**
    * Show the class progress reports page
    *
    * @return \Illuminate\Http\Response
    */
    public function report(){
        return view('class_report');
    }

    /**
     * Show the guided reading session page for the particular pupil
     *
     * @return \Illuminate\Http\Response
     */
    public function guided(Request $request)
    {
        return view('guided_reading');
    }


    //Method to check whether the book the teacher is about to assign has been assigned to that pupil before, and if so, warns the teacher before they proceed with the assignment
    public function validateAssignment(Request $request){
        //selected pupil's id
        $id = session('pid');

        $alreadyRead = DB::table('reading_records')
                ->join('pupils', 'reading_records.pupilID', '=', 'pupils.pupilID')
                ->join('books', 'reading_records.bookID', '=', 'books.bookID')
                ->join('teachers', 'reading_records.teacherID', '=', 'teachers.teacherID')
                ->select('books.title as title')
                ->where('pupils.pupilID', '=', $id)
                ->where('books.title', '=', $request->name)
                ->get();
        echo $alreadyRead . "</p>";

        //If the alreadyRead query returns an empty array, this means the book hasn't been assigned to this pupil before
        if(count($alreadyRead) < 1){
            $bool = 0;    //0 meaning false.
        }else{
            //query returned result so book has been assigned to the pupil before
            $bool = 1;   //1 meaning true.
        }        

        if($bool = 0){
            return false;
        }
        elseif($bool = 1){
            //duplicate book assignment detected
            return true;
        }
    }

    //Method to store assigned book into books and reading_records db tables
    public function store(Request $request){    
        //insert into books table
        $book = new Book; 
        //title - name
        $book->title = $request->name;
        //author
        $book->author = $request->author;
        //bookBand - band
        $book->bookBand = $request->band;
        //execute insert query
        $book->save();

        //Get bookid created above
        $bookID = DB::table('books')->max('bookID');

        //Get parent id associated with the pupil the book assignment is for
        $parentID = DB::table('pupils')->select('id as parentid')
                    ->where('pupilID', '=', session('pid'))
                    ->get();
        //trim $parentID to remove unnecessary brackets from query output            
        $parentID = ltrim($parentID,"[{\"parentid\":"); //trim characters before the id
        $parentID = rtrim($parentID,"}]");              //trim characters after the id 

        //insert into reading_records table
        $record = new ReadingRecord;
        //pupilID - obtained from pupilid stored in session
        $record->pupilID = session('pid');
        //bookID
        $record->bookID = $bookID;
        //dateAssigned - get the current date
        $record->dateAssigned = date('Y-m-d');
        //dueDate - due
        $record->dueDate = $request->due;
        //teacherID
        $record->teacherID = 2;
        //parentID
        $record->id = $parentID;
        //execute insert query
        $record->save();   
    }

    //Method to store guided reading session details into guidedsession and books db tables
    //and update the pupil's current reading level if teacher changed it
    public function storeGuided(Request $request){
        //insert into books table
        $book = new Book; 
        //title - bookname
        $book->title = $request->bookname;
        //author
        $book->author = $request->author;
        //bookBand - band
        $book->bookBand = $request->band;
        //execute insert query
        $book->save();

        //Get bookid created above
        $bookID = DB::table('books')->max('bookID');

        //insert into guidedsession table
        $guided = new GuidedSession;
        //pupilID - pupilID obtained from session data
        $guided->pupilID = session('pid');
        //teacherID
        $guided->teacherID = 2;
        //bookID
        $guided->bookID = $bookID;
        //session_date - get the current date
        $guided->session_date = date('Y-m-d');
        //notes
        $guided->notes = $request->notes;
        //execute insert query
        $guided->save();

        //update pupil table's reading_level 
        //if value of newlevel dropdown box was "no change"
        if($request->newlevel = "no_change"){
            //do nothing
        }else{
            //else, update the pupil table with the updated reading level
            $updatelevel = Pupil::where('pupilID', session('pid'))   //pupilID obtained from session data
                ->update(['readingLevel' => $request->newlevel]);
            //execute update query
            $updatelevel->save();    
        }
    }

    //Gets reading record of selected pupil from the database and
    //stores pupilid of selected pupil in teacher's session
    public function storeSessionData(Request $request, $id){

        $pupils = DB::table('reading_records')
        ->join('pupils', 'reading_records.pupilID', '=', 'pupils.pupilID')
        ->join('books', 'reading_records.bookID', '=', 'books.bookID')
        ->join('teachers', 'reading_records.teacherID', '=', 'teachers.teacherID')
        ->select('pupils.name as name', 'pupils.className as class', 'books.title as title', 'books.bookBand as level', 'books.author as author', 'teachers.name as assignedBy', 'reading_records.dateAssigned as dateAssigned', 'reading_records.dueDate as dueDate', 'reading_records.comment as parentComments')
        ->where('pupils.pupilID', '=', $id)
        ->get();

        $pupilID = $request->session()->put('pid', $id);
        //echo "Data has been added to session";
        //echo "<br>" . $request->session()->get('pid');

        return view('pupil_record', compact('pupils'));

    }


}
