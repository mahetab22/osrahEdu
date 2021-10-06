<?php

use App\Http\Controllers\Admin\userController as AdminUserController;

Route::get('admin', function () {
    return redirect('/admin');
 })->name('admin');


Route::group(['prefix' => 'admin',
'middleware' => [ 'admin' ,'auth']
], function () {
    Route::get('/','adminController@index');
    // --------------------- User ------------------------
    Route::resource('users','userController');
    Route::post('/user/active','userController@user_active')->name('userActive');
    Route::post('/user/delete_all','userController@delete_all');
    // ------------------ Course -------------------------
    Route::resource('/courses','courseController');
    Route::group(['prefix' => 'course'],function(){
        Route::post('/active','courseController@course_active')->name('courseActive');
        Route::post('/delete_all','courseController@delete_all');
        Route::get('/{id}/students','courseController@course_students');
        Route::post('/student/delete_all','courseController@delete_all_student');
        Route::post('/student/attend_all','courseController@attend_students');
        Route::get('student/reports/{id}','courseController@student_report');
    });

    // ------------------ Levels -------------------------
    Route::group(['prefix' => 'levels'],function(){
        Route::get('/course/{id}','levelController@index');
        Route::post('create/{id}','levelController@store');
        Route::post('update/{id}','levelController@update');
        Route::post('/delete_all','levelController@delete_all');
        Route::delete('/delete/{id}','levelController@destroy');
    });
    // ------------------ Lessons -------------------------
    Route::group(['prefix' => 'lessons'],function(){
        Route::get('/level/{id}','lessonController@index');
        Route::post('create/{id}','lessonController@store');
        Route::post('update/{id}','lessonController@update');
        Route::post('/delete_all','lessonController@delete_all');
        Route::delete('/delete/{id}','lessonController@destroy');
    });
    //-------------------Activities-------------------------

    Route::group(['prefix' => 'activities'],function(){
      Route::get('/{course}','ActivityController@index');
      Route::post('/create','ActivityController@store');
      Route::post('/update/{id}','ActivityController@update');
      Route::get('{id}/student_activity','ActivityController@student_activity');
      Route::post('/delete_all','ActivityController@delete_all');
      Route::delete('/delete/{id}','ActivityController@destroy');
      Route::post('/delete_all_student_activity','ActivityController@delete_all_student_activity');
    });
    Route::group(['prefix' => 'apps'],function(){
        Route::get('/{course}','ApplicationsForCourseController@index');
        Route::post('/create','ApplicationsForCourseController@store');
        Route::post('/update/{id}','ApplicationsForCourseController@update');
        Route::get('{id}/student_apps','ApplicationsForCourseController@student_apps');
        Route::post('/delete_all','ApplicationsForCourseController@delete_all');
        Route::delete('/delete/{id}','ApplicationsForCourseController@destroy');
        Route::post('/delete_all_student_apps','ApplicationsForCourseController@delete_all_student_apps');
      });
    // ------------------ Service -------------------------
    Route::resource('services','ServiceController');
    Route::post('/service/delete_all','ServiceController@delete_all');
    // ------------------ Questions -------------------------
    Route::resource('questions','QuestionsController');
    // ------------------ Teachers -------------------------
    Route::resource('teachers','TeachersController');
    Route::prefix('teacher')->group(function () {
        Route::post('/delete_all','TeachersController@delete_all');
        Route::get('/courses/{id}','SubscripeController@index');
        Route::get('subscripe/create/{id}','SubscripeController@create');
        Route::post('subscripe/store','SubscripeController@store');
        Route::post('subscripe/delete/{id}','SubscripeController@destroy');
    });
    // ------------------ Exams -------------------------
    Route::resource('exams','ExamController');
    Route::prefix('exam')->group(function () {
        Route::post('/delete_all','ExamController@delete_all');
        Route::get('/levels/{id}','ExamController@levels');
        Route::get('/lessons/{id}','ExamController@lessons');
        // ------------------ Exam Questions -------------------------
        Route::get('/{id}/questions','ExamQuestionsController@index');
        Route::get('/{id}/questions/create','ExamQuestionsController@create');
        Route::post('/{id}/questions/store','ExamQuestionsController@store');
        Route::get('/{id}/questions/{question_id}/edit','ExamQuestionsController@edit');
        Route::post('/{id}/questions/{question_id}/update','ExamQuestionsController@update');
    });


    // Voyager::routes();



    //-------------------contact controller---------------------
        Route::resource('/contact','contactController');
        Route::post('/contact/delete_all','contactController@delete_all');
        Route::get('contact/{id}/read','contactController@read');
        Route::resource('/contactType','contactTypeController');
        Route::post('/contactType/delete_all','contactTypeController@delete_all');

    //-----------------------news controller----------------------
        Route::resource('/news','newsController');
        Route::post('/news/delete_all','newsController@delete_all');
    // ------------------ Library -------------------------
        Route::resource('/library','LibraryController');
        Route::post('/library/delete_all','LibraryController@delete_all');
    //--------------------------new email-------------------------
        Route::resource('/newsEmail','newsEmailController');
        Route::post('/newsEmail/delete_all','newsEmailController@delete_all');
        //------------------------said about us-------------------
        Route::resource('/said/about/us','saidAboutUsController');
        Route::post('/said/about/us/delete_all','saidAboutUsController@delete_all');
        //------------------------Terms And Condition -------------------
        Route::resource('/terms','TermAndConditionController');
        Route::post('/terms/delete_all','TermAndConditionController@delete_all');
        //------------------------ FAQ -------------------
        Route::resource('/faqs','FAQController');
        Route::post('/faqs/delete_all','FAQController@delete_all');
        //------------------------ FAQ -------------------
        Route::get('/info/{word}','SiteController@index');
        Route::post('/info/{word}/update','SiteController@update');
        //------------------------ FAQ -------------------
        Route::resource('/partners','PartnerController');
        Route::post('/partners/delete_all','PartnerController@delete_all');

        //------------------------survey-------------------
        Route::get('survey','adminController@survey');
        Route::post('/survey/delete_all','adminController@delete_all');
        //------------------------ Breadcrumbs -------------------
        Route::resource('/breadcrumbs','BreadcrumbController');

    });



?>
