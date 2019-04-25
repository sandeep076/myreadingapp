<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    /**
     *Test that the homepage displays when it is requested
     */
    public function displayHomepage(){
    	$this->get('/')->assertSee('The app to guide teachers, children and parents on the reading learning journey');
    }    

    /**
     *Test that teacher login displays when requested
     */
    public function displayTeacherLogin(){
    	$this->get('/teacher/login')->assertSee('Teacher Login');
    }

    /**
     *Test teacher login attempt with incorrect password
     */
    public function teacherLoginIncorrectPassword(){
    	$this->visit('/teacher/login')
         ->type('nina@gmail.com', 'email')
         ->type('taylor', 'password')
         ->press('Login')
         ->assertPathIs('/teacher/login');
    }

    /**
     *Test teacher login attempt with incorrect email address
     */
    public function teacherLoginIncorrectEmail(){
    	$this->visit('/teacher/login')
         ->type('nina', 'email')
         ->type('password', 'password')
         ->press('Login')
         ->assertPathIs('/teacher/login');
    }

    /**
     *Test parent attempting to login using the teacher login page
     */
    public function parentLoginAsTeacher(){
    	$this->visit('/teacher/login')
         ->type('rosehuffman@gmail.com', 'email')
         ->type('123456', 'password')
         ->press('Login')
         ->assertPathIs('/teacher/login');
    }

    /**
     *Test that teacher dashboard displays all pupils in teacher's class
     */
    public function displayTeacherDashboard(){
    	//Login Teacher - once called, this method should keep teacher logged in for the rest of the test methods below this method.
    	$this->browse(function ($first, $second){
    		$first->loginAs(Teacher::find(2))
          ->visit('/teacher/teacher_dashboard');
        });  
        //Check that teacher_dashboard displays all pupils in teacher's class
        $this->get('/teacher/teacher_dashboard')->assertSee('Teacher Dashboard');
    }

    /**
     *Test that a pupil's reading record displays when requested 
     */
    public function displayPupilRecord(){
    	$browser->clickLink('/teacher/pupil_record/1')->assertSee('Lilly Smith\'s Reading Record');
    }

    /**
     *Test 'Assign book' functionality works with valid data
     */
    public function assignBook(){
    	$this->visit('/teacher/pupil_record/1')
         ->type('Kipper\'s Birthday', 'name')
         ->type('R. Hunt', 'author')
         ->type('yellow', 'band')
         ->type('08/06/2019', 'due')
         ->press('Assign')
         ->assertPathIs('/records');
    }

    /**
     *Test that 'Add Guided Reading Session' functionality works with valid data
     */
    public function addGuidedReading(){
    	$this->visit('/teacher/pupil_record/1')
         ->type('Kipper\'s Birthday', 'bookname')
         ->type('R. Hunt', 'author')
         ->type('yellow', 'band')
         ->type('Was able to read this fluently', 'notes')
         ->type('no_change', 'newlevel')
         ->press('Add Guided Reading Session')
         ->assertPathIs('/sessionstored');
    }

    /**
     *Test that parent login displays when requested
     */
    public function displayParentLogin(){
    	$this->get('/login')->assertSee('Parent Login');
    }

    /**
     *Test parent login attempt with incorrect password
     */
    public function parentLoginIncorrectPassword(){
    	$this->visit('/login')
         ->type('rosehuffman@gmail.com', 'email')
         ->type('rose', 'password')
         ->press('Login')
         ->assertPathIs('/login');
    }

    /**
     *Test parent login attempt with incorrect email address
     */
    public function parentLoginIncorrectEmail(){
    	$this->visit('/login')
         ->type('rose', 'email')
         ->type('123456', 'password')
         ->press('Login')
         ->assertPathIs('/login');
    }

    /**
     *Test teacher attempting to login using their own credentials in the parent login page
     */
    public function teacherLoginAsParent(){
    	$this->visit('/login')
         ->type('nina@gmail.com', 'email')
         ->type('password', 'password')
         ->press('Login')
         ->assertPathIs('/login');
    }

    /**
     *Test that parent dashboard displays when requested
     */
    public function displayParentDashboard(){
    	//Login Parent
    	$this->browse(function ($first, $second){
    		$first->loginAs(User::find(1))
          ->visit('/parent_dashboard');
        });  
        //Check that parent_dashboard displays their children
        $this->get('/parent_dashboard')->assertSee('Parent Dashboard');
    }

    /**
     *Test that a child's reading record displays when requested 
     */
    public function displayChildRecord(){
    	$browser->clickLink('/child_record/2')->assertSee('Carey Huffman\'s Reading Record');
    }

	/**
     *Test that 'Add Comments' functionality works with valid data
     */
    public function addComments(){
    	$this->visit('/child_record/2')
         ->type('Kipper\'s Birthday', 'bookname')
         ->type('Read up to page 20. Enjoying reading this one. Sounded out the words to eventually understand them.', 'comment')
         ->press('Submit')
         ->assertPathIs('/comments_saved');
    }    

}
