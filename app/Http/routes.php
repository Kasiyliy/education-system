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
Route::group(['middleware' => ['language',]], function () {
    Route::get('/', ['as' => 'homestudent.guest', 'uses' => 'HomeStudentController@guest']);
    Route::get('/mail', array('as' => 'mail', 'uses' => 'HomeController@mail'));
    Route::get('/login', array('as' => 'home', 'uses' => 'HomeController@index'));
    Route::get('/setlangrus', array('as' => 'setlangrus', 'uses' => 'HomeController@setLangRus'));
    Route::get('/setlangeng', array('as' => 'setlangeng', 'uses' => 'HomeController@setLangEng'));
    Route::get('/ourvalues', array('as' => 'ourvalues', 'uses' => 'HomeController@ourvalues'));
    Route::get('/contacts', array('as' => 'contacts', 'uses' => 'HomeController@contacts'));
    Route::get('/feedback', array('as' => 'feedback', 'uses' => 'HomeController@feedback'));

    Route::get('/feedback_admin', array('as' => 'feedback.admin', 'uses' => 'HelpFeedbackController@index'));
    Route::post('/feedback_admin/{id}', array('as' => 'feedback.destroy', 'uses' => 'HelpFeedbackController@destroy'));
    Route::get('/feedback_admin/{id}', array('as' => 'feedback.answer', 'uses' => 'HelpFeedbackController@answer'));
    Route::post('/feedback/send_answer', array('as' => 'feedback.send_answer', 'uses' => 'HelpFeedbackController@sendanswer'));

    Route::get('/help', array('as' => 'help', 'uses' => 'HomeController@help'));
    Route::post('/help_send', array('as' => 'help.feedback', 'uses' => 'HelpFeedbackController@helpfeedback'));
    Route::post('/feedback_send', array('as' => 'help.feedback_send', 'uses' => 'HelpFeedbackController@feedbacksend'));
    Route::get('/lock', array('as' => 'lock', 'uses' => 'HomeController@lock'));

    Route::post('/user/login', ['as' => 'user.login', 'uses' => 'UserController@login']);
    Route::get('/user/logout', ['as' => 'user.logout', 'uses' => 'UserController@logout']);

    Route::get('/guest', ['as' => 'homestudent.guest', 'uses' => 'HomeStudentController@guest']);
    Route::get('/subjects', ['as' => 'homestudent.subjects', 'uses' => 'StudentSubjectsController@index']);

    Route::get('/subjects/{id}', ['as' => 'subjects.specific', 'uses' => 'StudentSubjectsController@showSubjects']);

    Route::get('/astcglobal_certificate/{id}', ['as' => 'astcglobal_certificate', 'uses' => 'CertificateController@give']);

    Route::group(['prefix' => 'student', 'middleware' => ['for.student', 'auth']], function () {
        Route::get('/my/subjects', ['as' => 'student.my.subjects', 'uses' => 'StudentSubjectsController@mySubjects']);
        Route::get('/my/subjects/{id}', ['as' => 'student.my.subjects.specific', 'uses' => 'StudentSubjectsController@show']);
        Route::get('/my/subjects/lesson/{id}', ['as' => 'student.my.subjects.specific.lesson', 'uses' => 'StudentSubjectsController@showLesson']);
        Route::get('/my/subjects/{id}/chat', ['as' => 'student.my.subjects.chat', 'uses' => 'StudentSubjectsController@chat']);
        Route::get('/my/subjects/quiz/{id}', ['as' => 'student.my.subjects.specific.quiz', 'uses' => 'StudentSubjectsController@showQuiz']);
        Route::get('/lesson_part/next_question/{id}', ['as' => 'lesson_part.next_question', 'uses' => 'StudentSubjectsController@nextLessonPart']);
        Route::get('/certificate/{id}', ['as' => 'certificate', 'uses' => 'CertificateController@give']);
        Route::post('/quizresult', ['as' => 'quizresult.store', 'uses' => 'QuizResultController@store']);
        Route::post('/certificate/{student_id}/{course_id}', ['as' => 'certificate.put_info', 'uses' => 'GiveCertificateController@put_info']);
        Route::post('/send/certificate/{student_id}/{course_id}', ['as' => 'certificate.send_email', 'uses' => 'GiveCertificateController@send_email']);
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('message', 'MessageController');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {

        Route::get('/certificate/index', ['as' => 'certificate.index', 'uses' => 'HomeController@certificates']);
        Route::get('/teacher/control', ['as' => 'teacher.control', 'uses' => 'TeacherControlController@index']);

    });

    Route::group(['middleware' => ['not.for.student', 'auth']], function () {
        Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);
        Route::get('/institute', ['as' => 'institute.index', 'uses' => 'InstituteController@index']);
        Route::post('/institute', ['as' => 'institute', 'uses' => 'InstituteController@save']);

        Route::resource('user', 'UserController');
        Route::get('/settings/{id}', ['as' => 'user.settings', 'uses' => 'UserController@settings']);
        Route::post('/settings',[ 'as' => 'user.postsettings','uses'=>'UserController@postSettings']);


        Route::get('/instruction',[ 'as' => 'instruction.show','uses'=>'HomeController@instruction']);


        Route::get('/addstudent', ['as' => 'user.addstudent', 'uses' => 'UserController@addstudent']);
        Route::post('/addstudent', ['as' => 'user.addstudent', 'uses' => 'UserController@createstudent']);
        Route::post('/addstudent/deleteAccount/{user_id}', ['as' => 'user.deleteAccount', 'uses' => 'UserController@deleteAccount']);

        Route::resource('department', 'DepartmentController');

        Route::resource('subject', 'SubjectController');
        Route::get('subject/{deparment}/{semester}', ['as' => 'subject.DeptAndSem', 'uses' => 'SubjectController@subjetsByDptSem']);

        Route::get('student/MyStudents/{id}', ['as' => 'teacher_student.index', 'uses' => 'StudentController@teacherStudentList']);

        Route::get('/certificate/information', ['as' => 'certificate.information', 'uses' => 'GiveCertificateController@index']);

        Route::get('/certificate/update/{id}', ['as' => 'certificate.update', 'uses' => 'GiveCertificateController@update']);
        Route::post('/certificate/change/{certificate_id}/{subject_id}', ['as' => 'certificate.change', 'uses' => 'GiveCertificateController@change']);
        Route::get('/certificate/show', ['as' => 'certificate.show', 'uses' => 'HomeController@subject_certificate']);

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
        Route::get('result-quiz', ['as' => 'result.quiz', 'uses' => 'QuizResultController@index']);
        Route::post('result-quiz/{id}', ['as' => 'result.quiz.delete', 'uses' => 'QuizResultController@destroy']);

        Route::resource('quiz', 'QuizController');
        Route::post('quiz/{quizID}/question', ['as' => 'quiz.question.create', 'uses' => 'QuestionController@createQuestion']);
        Route::get('quiz/{id}/questions/index', ['as' => 'quiz.questions.index', 'uses' => 'QuestionController@index']);

        Route::resource('question', 'QuestionController');

        Route::resource('lesson', 'LessonController');
        Route::get('lesson-part/{id}', ['as' => 'lesson-part.index', 'uses'=>'LessonPartController@index']);
        Route::post('lesson-part/{id}', ['as' => 'lesson-part.destroy', 'uses'=>'LessonPartController@destroy']);
        Route::get('lesson-part/edit/{id}', ['as' => 'lesson-part.edit', 'uses'=>'LessonPartController@edit']);
        Route::post('lesson-part/update/{id}', ['as' => 'lesson-part.update', 'uses'=>'LessonPartController@update']);
        Route::post('lesson-part', ['as' => 'lesson-part.store', 'uses'=>'LessonPartController@store']);

        Route::get('message/{studentId}/{subjectId}', ['as' => 'message.show2', 'uses' => 'MessageController@show2']);

    });
});