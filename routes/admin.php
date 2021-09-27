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
        Route::post('course/student/delete_all','courseController@course_students');
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
    });



?>
