<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function(){
    return view('about');
});

Route::get('teacher-register', function(){
    return view('auth/teacher-register');
});

Route::post('/teacher-register', 'Auth\TeacherRegisterController@register')->name('teacher.register.submit');

//parent selecting child's record
Route::get('child_record/{id}', function($id){
	//get current;y logged in parent's id
	$pid = Auth::id();

	$children = DB::table('reading_records')
		->join('pupils', 'reading_records.pupilID', '=', 'pupils.pupilID')
		->join('users', 'reading_records.id', '=', 'users.id')
		->join('books', 'reading_records.bookID', '=', 'books.bookID')
		->join('teachers', 'reading_records.teacherID', '=', 'teachers.teacherID')
        ->select('reading_records.recordID as rid', 'pupils.name as name', 'pupils.className as class', 'pupils.readingLevel as level', 'books.title as title', 'books.bookBand as level', 'books.author as author', 'teachers.name as assignedBy', 'reading_records.dateAssigned as dateAssigned', 'reading_records.dueDate as dueDate', 'reading_records.comment as parentComments')
        ->where('pupils.pupilID', '=', $id)
        ->where('users.id', '=', $pid)
        ->get();

	return view('child_record', compact('children'));
})->name('childrecord');	

//save parent's comments (code is in the parent controller)
Route::post('/comments_saved','ParentController@update')->name('parent.comment.submit'); 

//logged in as teacher
Route::get('/teacher/home', 'TeacherController@index');

//logged in as parent
Route::get('/home', 'ParentController@index');

//log out parent
Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

//logout teacher
Route::get('/logoutTeacher', 'Auth\TeacherLoginController@teacherLogout')->name('teacher.logout');

Route::prefix('teacher')->group(function(){
	Route::get('/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
	Route::post('/login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
	Route::get('/', 'TeacherController@index')->name('teacher.dashboard');
});	

Route::get('teacher/pupil_record/{id}', function($id, Request $request){
	$pupils = DB::table('reading_records')
			->join('pupils', 'reading_records.pupilID', '=', 'pupils.pupilID')
			->join('books', 'reading_records.bookID', '=', 'books.bookID')
			->join('teachers', 'reading_records.teacherID', '=', 'teachers.teacherID')
            ->select('pupils.name as name', 'pupils.className as class', 'books.title as title', 'books.bookBand as level', 'books.author as author', 'teachers.name as assignedBy', 'reading_records.dateAssigned as dateAssigned', 'reading_records.dueDate as dueDate', 'reading_records.comment as parentComments')
            ->where('pupils.pupilID', '=', $id)
            ->get();
    //save selected pupil's id to session with the key 'pid'        
    session(['pid' => $id]);
    //\Log::info('Pupil id is: ' . session('pid'));	//for testing    

	return view('pupil_record', compact('pupils'));
})->name('readingrecord');

//for livesearch feature on pupil_record page - calls fetch() method from LiveSearch controller
Route::post('teacher/pupil_record/', 'LiveSearch@fetch')->name('livesearch.fetch');

//teacher assigning book to pupil (store() method is in the teacher controller)
Route::post('/records','TeacherController@store')->name('teacher.assignment.submit');

//guided() method is in the teacher controller
Route::get('teacher/guided_reading', 'TeacherController@guided')->name('teacher.guided');

//Go to teacher's class report page
Route::get('teacher/class_report', 'TeacherController@report')->name('teacher.report');

//teacher recording guided reading session with them and a particular pupil (storeGuided method is in the teacher controller)
Route::post('/sessionstored','TeacherController@storeGuided')->name('teacher.guided.submit');

Route::auth();










