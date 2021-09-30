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

use App\Course;
use App\Token;
use App\Streaming;
use App\Session;


Route::get('/auth','ZoomController@authZoom')->middleware(['auth']);

Route::get('stream','ZoomController@meeting_status');


Route::get('set-session/{id}',function($id){
//dd('');

    if(count(Session::all())==1)
    {
        Session::first()->update(['course_id'=>$id,'type'=>"create"]);}
    else
        Session::create(['course_id'=>$id,'type'=>"create"]);

  /*  session()->flash('course_id',$id);

    session()->flash('type','create');*/
});


Route::get('set-session-detail/{id}',function($id){
//dd('');
    if(count(Session::all())==1)
    {
        Session::first()->update(['course_id'=>$id,'type'=>"detail"]);}
    else
        Session::create(['course_id'=>$id,'type'=>"detail"]);
});
Route::get('set-session-delete/{id}',function($id){
//dd('');
    if(count(Session::all())==1)
    {
        Session::first()->update(['type'=>"delete",'class_id'=>$id]);}
    else
        Session::create(['type'=>"delete",'class_id'=>$id]);
});
Route::get('set-session-update/{id}',function($id){
//dd('');

    if(count(Session::all())==1)
    {
        Session::first()->update(['type'=>"update",'class_id'=>$id]);}
    else
        Session::create(['type'=>"update",'class_id'=>$id]);
});
Route::get('set-session-record/{id}',function($id){
//dd('');
    if(count(Session::all())==1)
    {
        Session::first()->update(['type'=>"record",'class_id'=>$id]);}
    else
        Session::create(['type'=>"record",'class_id'=>$id]);
});

Route::post('/create-meeting','ZoomController@create_meeting')->name('create_meeting');

Route::post('/update-meeting/{id}','ZoomController@update_meeting')->name('update_meeting');



//Route::get('/auth','ZoomController@auth')->name('auth-zoom');

Route::get('/session', function () {
return session()->get('course_id');
});
Route::get('/apply',function(){

if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
//whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
//whether ip is from remote address
    else
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    echo $ip_address;
});

Route::get('/testblade', function () {
    return view('profile.testblade');

});
Route::get('/test', 'VisionController@test')->name('/test');

Route::post('Logout/form','Auth\LoginController@logout')->name('Logout-form');
Route::post('add-link','courseController@add_link')->name('addLink');
//Route::post('/test/lesson', 'VisionController@lesson')->name('/test/lesson');

     //     - - ------------    start ajax   ----------- - -
    Route::post('/mycourse/lesson', 'ajaxController@lesson')->name('/mycourse/lesson');
    Route::post('/mycourse/exam', 'ajaxController@exam')->name('/mycourse/exam');
    Route::post('/smycourse/lesson', 'ajaxController@slesson')->name('/smycourse/lesson');
    Route::post('/smycourse/exam', 'ajaxController@sexam')->name('/smycourse/exam');
    //     - - ------------    start ajax   ----------- - -
Route::get('/Artisan', function () {
    Artisan::call('storage:link');
//Artisan::call('config:cache');
//Artisan::call('cache:clear');
echo 'success';
});





Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'HttpsProtocol' ]
], function(){ //...

Auth::routes();

Route::get('/testnotiphy', 'VisionController@testnotiphy')->name('/testnotiphy');
//     - - ------------    aboutController   ----------- - -
	Route::get('/', 'indexController@index')->name('/');
    Route::get('/news', 'indexController@news')->name('news');
    Route::get('/single/{id}/news', 'indexController@single_news')->name('single_news');
    Route::get('/books', 'indexController@books')->name('books');
    Route::get('/single/{id}/books', 'indexController@single_books')->name('single_books');

	Route::get('/home', 'indexController@index')->name('home');
    Route::get('/conditions', 'indexController@conditions')->name('conditions');
// ------------------------marketer--------------------------
Route::get('pay/Marketer/{id}','indexController@payMarketer')->name('payMarketer');
//     - - ------------    aboutController   ----------- - -
	Route::get('/about', 'aboutController@about')->name('about');

//     - - ------------    contactController   ----------- - -
	Route::get('/contact', 'contactController@contact')->name('contact');
	Route::post('/addcontacts', 'contactController@addcontacts')->name('addcontacts');
	Route::post('/addnewemail', 'contactController@addnewemail')->name('addnewemail');
    Route::post('/Registercontacts', 'contactController@Registercontacts')->name('Registercontacts');
     Route::get('/admin/{notification}/contacts','contactController@getcontactsnotification');

//     - - ------------  start courseController    ----------- - -

	Route::get('/courses', 'courseController@course')->name('courses');
    Route::get('/ajax/courses','courseController@course_ajax');
	//Route::get('/courseSingle', 'courseController@courseSingle')->name('courseSingle');
    Route::get('/courseSingle', 'courseController@coursedSingle')->name('coursedSingle');
	Route::get('/coursedSingle', 'courseController@coursedSingle')->name('coursedSingle');
	Route::get('/course/{course}/view','courseController@getcourseSingle');
	Route::get('/coursed/{course}/view','courseController@getcoursedSingle');
    Route::post('/checkcode', 'courseController@checkcode')->name('checkcode');
    Route::post('/checkpubliccode', 'courseController@checkpubliccode')->name('checkpubliccode');
    Route::get('/exambyid/{exam}','authCourseController@getexambyid');
    Route::get('/examcourse/{course}','authCourseController@getexamcourse');
    Route::get('/editexamcourse/{course}','authCourseController@geteditexamcourse');
    Route::get('/editexamcourseby/{exam}','authCourseController@geteditexamcourseexam');
    Route::get('/addexamcourse/{course}','authCourseController@getaddexamcourse');
    Route::get('/examResults/{exam_id}','authCourseController@examResults');
//     - - ------------  end courseController    ----------- - -

//     - - ------------   CourseSubscriptionController    ----------- - -
    Route::get('/editcourse/{course}/','CourseSubscriptionController@geteditcourse');
	Route::get('/mycourse/{course}/','CourseSubscriptionController@getmycourse');
	Route::get('/subscribe/{course}', 'CourseSubscriptionController@subscribe');
    Route::get('/subscribemag/{course}', 'CourseSubscriptionController@subscribemag');
    //Route::post('/subscribe', 'CourseSubscriptionController@subscribee')->name('subscribe');
    Route::get('/stusubscriptioncourse/{id}', 'CourseSubscriptionController@stusubscriptioncourse')->name('stusubscriptioncourse');
    Route::get('/supervactive/{id}', 'CourseSubscriptionController@supervactive')->name('supervactive');
    Route::get('/courseactive/{id}', 'CourseSubscriptionController@courseactive')->name('courseactive');
    Route::get('/studcourse/{id}', 'CourseSubscriptionController@studcourse')->name('studcourse');
    Route::get('/stop_subscription/{id}', 'CourseSubscriptionController@stop_subscription')->name('stop_subscription');
    ////subscribe_meeting    under    CourseSubscriptionController    Esraa//////
    Route::post('/subscripe-meeeting', 'CourseSubscriptionController@subscripe_meeting')->name('subscripeMeeting');

//     - - ------------  start authCourseController    ----------- - -

    Route::post('/remove', 'authCourseController@remove')->name('remove');
    Route::post('/updatecourse', 'authCourseController@updatecourse')->name('updatecourse');
    Route::post('/addcourse', 'authCourseController@addcourse')->name('addcourse');
	Route::post('/addlevel', 'authCourseController@addlevel')->name('addlevel');
	Route::post('/addlesson', 'authCourseController@addlesson')->name('addlesson');
	Route::post('/addexam', 'authCourseController@addexam')->name('addexam');
    Route::post('/addtonewpublicexam', 'authCourseController@addtonewpublicexam')->name('addtonewpublicexam');
	Route::post('/addtonewexam', 'authCourseController@addtonewexam')->name('addtonewexam');
	Route::post('/addtoexam', 'authCourseController@addtoexam')->name('addtoexam');

    Route::post('/uploadimg', 'authCourseController@uploadimg')->name('uploadimg');

    Route::post('/adddiscount', 'authCourseController@adddiscount')->name('adddiscount');
    Route::post('/addcode', 'authCourseController@addcode')->name('addcode');
    Route::post('/addpubliccode', 'authCourseController@addpubliccode')->name('addpubliccode');
    Route::get('/examcode/{examcode}/update','authCourseController@update_examcode');
    Route::get('/examcode/{examcode}/delete','authCourseController@delete_examcode');
    Route::get('/discountcode/{discount}/delete','authCourseController@discountcode');
    Route::get('/deletequestion/{question}/delete','authCourseController@deletequestion');
    Route::get('/exam/{exam}/deleteexam','authCourseController@deleteexam');
    Route::get('/exam/{exam}/heddinexam','authCourseController@heddinexam');
    Route::get('/exam/{exam}/viewexam','authCourseController@viewexam');

    Route::get('/checkcodediscount','authCourseController@checkcodediscount')->name('checkcodediscount');

	Route::post('/addcomment', 'authCourseController@addcomment')->name('addcomment');
	Route::post('/replaycomment', 'authCourseController@replaycomment')->name('replaycomment');

    Route::get('/editsuperprofile/{user}/','authCourseController@geteditsuperprofile');
    Route::get('/editprofile/{user}/','authCourseController@geteditprofile')->name('edit_profile');

    Route::post('/addcertificate', 'authCourseController@addcertificate')->name('addcertificate');
    Route::get('/addcertificate', 'authCourseController@addcertificate');
	Route::get('/hiddencertificate', 'authCourseController@hiddencertificate');
	Route::post('add-certificate-all','authCourseController@add_certificate_all')->name("certificate_all");

    Route::post('/addmassage', 'authCourseController@addmassage')->name('addmassage');
    Route::get('/notifications/{notification}/show','authCourseController@getnotification');
    Route::get('/notifications/{notification}/commentshow','authCourseController@getcommentnotification');
    Route::get('/conversation/{conversation}/show','authCourseController@getconversation');
    Route::get('/conversation/{user}/{course}/studshow','authCourseController@getstudconversation');
    Route::get('/certificate', 'authCourseController@certificate')->middleware(['auth']);

//     - - ------------  End authCourseController    ----------- - -



	// Route::get('/department/{department}/view','courseController@getdepartment');
	// Route::get('/moredepartments','courseController@getalldepartment');

//     - - ------------    examController   ----------- - -
	Route::get('/exam', 'examController@exam')->name('exam');
	Route::post('/postexam', 'examController@postexam')->name('postexam');
    Route::post('/postpublicexam', 'examController@postpublicexam')->name('postpublicexam');

//     - - ------------   comquestionController    ----------- - -
	Route::get('/comquestion', 'comquestionController@comquestion')->name('comquestion');
	Route::get('/comquestion/{commonquestion}/view','comquestionController@getcommonQuestion');

//     - - ------------    authController   ----------- - -
	Route::get('/registerStudent', 'authController@registerStudent')->name('registerStudent');
	Route::get('/registerSupervisor', 'authController@registerSupervisor')->name('registerSupervisor');
	Route::get('/registerMarketer', 'authController@registerMarketer')->name('registerMarketer');
	Route::get('/registerorlogin', 'authController@registerorlogin')->name('registerorlogin');
	Route::post('/Register', 'authController@Register')->name('Register');
	Route::post('/SignIn', 'authController@SignIn')->name('SignIn');
	Route::post('/changepassword','authController@changepassword')->name('changepassword');
	Route::get('/mycourseafter/{course}/','authController@getmycourse');


//     - - ------------    servicesController   ----------- - -
	Route::get('/service/{service}/view','servicesController@getservice');
	Route::get('/moreservices','servicesController@getallservice')->name('moreservices');

    Route::get('/specializedServices','servicesController@specializedServices')->name('specializedServices');
    Route::get('/specializedServices/{department}/view','servicesController@getspecializedServices');

//     - - ------------    teamController   ----------- - -
	Route::get('/team', 'teamController@team')->name('team');
    Route::get('/superprofile/{user}/', 'teamController@superprofile');

//     - - ------------    termsController   ----------- - -
	Route::get('/terms', 'termsController@terms')->name('terms');


//     - - ------------    searchController   ----------- - -
	Route::get('/search', 'searchController@search')->name('search');

//     - - ------------    userController   ----------- - -
	Route::post('/addachievement', 'userController@addachievement')->name('addachievement');
    Route::post('/updateProfile', 'userController@updateProfile')->name('updateProfile');
	Route::get('/profile', 'userController@profile')->name('profile');
	Route::get('/supervprofile', 'userController@supervprofile')->name('supervprofile');
    Route::get('/marketer/Profile','userController@marketerProfile')->name('marketerProfile');

//     - - ------------    HomeController   ----------- - -
	Route::post('/Logout', 'HomeController@Logout')->name('Logout');

//     - - ------------    multiController   ----------- - -
	Route::post('/addsupercourse', 'multiController@addsupercourse')->name('addsupercourse');
    Route::post('/editsupercourse', 'multiController@editsupercourse')->name('editsupercourse');
    Route::post('/deletesupercourse', 'multiController@deletevisorcourse')->name('deletesupercourse');
	Route::post('/addsuperlesson', 'multiController@addsuperlesson')->name('addsuperlesson');
    Route::post('/editsuperlesson', 'multiController@editsuperlesson')->name('editsuperlesson');
    Route::post('/deletesuperlesson', 'multiController@deletevisorlesson')->name('deletesuperlesson');

//     - - ------------    END ROUTES  ----------- - -


});//  --  ------------  end Localization    ----------- - -
