<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::get('/login', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::get('/lock', array('as' => 'lock', 'uses' => 'HomeController@lock'));
Route::get('/', "HomeController@index");

Route::post('/user/login', ['as' => 'user.login', 'uses' => 'UserController@login']);
Route::get('/user/logout', ['as' => 'user.logout', 'uses' => 'UserController@logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);
    Route::get('/institute', ['as' => 'institute.index', 'uses' => 'InstituteController@index']);
    Route::post('/institute', ['as' => 'institute', 'uses' => 'InstituteController@save']);

    Route::resource('user', 'UserController');
    Route::get('/settings', ['as' => 'user.settings', 'uses' => 'UserController@settings']);
    Route::post('/settings', ['as' => 'user.settings', 'uses' => 'UserController@postSettings']);

    Route::resource('department', 'DepartmentController');

    Route::resource('subject', 'SubjectController');
    Route::get('subject/{deparment}/{semester}', ['as' => 'subject.DeptAndSem', 'uses' => 'SubjectController@subjetsByDptSem']);


    Route::resource('student', 'StudentController');
    Route::post('student/department', ['as' => 'student.department', 'uses' => 'StudentController@index2']);
    Route::get('students/subject/{subID}', ['as' => 'students.departmentAndsession', 'uses' => 'StudentController@studentList']);
    Route::get('students/{dID}/{session}/{semester}', ['as' => 'students.registered', 'uses' => 'StudentController@registeredStudentList']);
    Route::get('student-registration', ['as' => 'student.registration.create', 'uses' => 'StudentController@regCreate']);
    Route::post('student-registration', ['as' => 'student.registration.store', 'uses' => 'StudentController@regStore']);
    Route::get('student-registration/{id}/delete', ['as' => 'student.registration.destroy', 'uses' => 'StudentController@regDestroy']);
    Route::get('registered-students', ['as' => 'student.registration.index', 'uses' => 'StudentController@regIndex']);
    Route::post('registered-students', ['as' => 'student.registration.list', 'uses' => 'StudentController@regList']);


    Route::get('quiz/by-subject-api', ['as' => 'quiz.index3', 'uses' => 'QuizController@index3']);
    Route::get('quiz/by-subject', ['as' => 'quiz.index2', 'uses' => 'QuizController@index2']);
    Route::get('quiz/{id}/questions/edit', ['as' => 'quiz.questions', 'uses' => 'QuizController@questions']);
    Route::get('result-subject', ['as' => 'result.subject', 'uses' => 'ResultController@getSubject']);
    Route::post('result-subject', ['as' => 'result.subject.post', 'uses' => 'ResultController@postSubject']);
    Route::get('result-student', ['as' => 'result.individual', 'uses' => 'ResultController@getStudent']);
    Route::post('result-student', ['as' => 'result.individual.post', 'uses' => 'ResultController@postStudent']);

    Route::resource('quiz', 'QuizController');
    Route::post('quiz/{quizID}/question', ['as' => 'quiz.question.create','uses' =>'QuestionController@createQuestion']);
    Route::get('quiz/{id}/questions/index', ['as' => 'quiz.questions.index', 'uses' => 'QuestionController@index']);

    Route::resource('question', 'QuestionController');
    Route::resource('lesson', 'LessonController');

    //barcode generate
    Route::get('/barcode', 'barcodeController@index');
    Route::post('/barcode', 'barcodeController@generate');
});
