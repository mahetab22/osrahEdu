<?php

namespace App\Http\Controllers;
use App\Http\authenticateZoom;
use Illuminate\Http\Request;
use App\Streaming;
use App\Course;
use App\Comment;
use App\Notifications\commentNotify;
use Notification;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Validator;

use App\Token;

use App\Session;


class ZoomController extends HomeController
{



    function  authZoom()
    {

        try {
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);

            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic " . base64_encode('CFcnxH_7SeiMz04zFK_g0w' . ':' . 'KdxhDw5lI1NMZJp3YONqHlN24gqPkzaM')
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $_GET['code'],
                    "redirect_uri" => 'https://nhledu.com/auth'
                ],
            ]);


            $token = json_decode($response->getBody()->getContents(), true);


            if ($token2 = Token::where('user_id', auth()->user()->id)->first()) {
                $token2->update(['access_token' => json_encode($token)]);
                // return $token2->access_token;
            } else {

                \App\Token::create(['access_token' => json_encode($token), 'user_id' => auth()->id()]);
            }


            $course = Course::find(Session::first()->course_id);
            $session = Session::first();
            switch ($session->type) {

                case 'create':
                    return view('profile.meeting_form', compact('course'));
                case 'update':
                    {
                        $class_id = $session->class_id;
                        $stream = Streaming::where('class_id', $class_id)->first();

                        $date1 = explode(' ', $stream->start_time);
//dd($date1);
                        $date = $date1[0] . 'T' . $date1[1];

                        return view('profile.meeting_form', compact('course', 'stream', 'date'));
                    }
                    break;
                case 'delete':

                    // dd($session->class_id);
                    try {
                        Streaming::where('class_id', $session->class_id)->first()->delete();
                        $arr_token = json_decode(\App\Token::where('user_id', auth()->user()->id)->first()->access_token);
                        $accessToken = $arr_token->access_token;
                        $response = $client->request('DElETE', 'v2/meetings/' . $session->class_id, ["headers" => [
                            "Authorization" => "Bearer $accessToken"]]);


                        $response = json_decode($response->getBody());

                        //   dd($response);

                        session()->put('message', 'تم الغاء الاجتماع الخاص بك ف زوم');
                        // dd('j');
                        return redirect()->back();
                        break;
                    } catch (\Exception $e) {
                        return redirect()->route('home');

                    }


                case 'record':


                    $arr_token = json_decode(\App\Token::where('user_id', auth()->user()->id)->first()->access_token);
                    $accessToken = $arr_token->access_token;
                    try {
                        $response = $client->request('get', 'v2/past_meetings/82547246455/files', ["headers" => [
                            "Authorization" => "Bearer $accessToken"]]);
                        $response = json_decode($response->getBody());
//dd($response);
                        if (isset($response->in_meeting_files['download_url']))
                            return Redirect::to($response->in_meeting_files['download_url']);
                        else
                            return view('records');

                        // dd('j');
                        //return redirect()->back();

                    } catch (\Exception $e) {
                        // echo ' لا يوجد تسجيلات لهذه الجلسه';
                        return view('records');

                    }


            }


        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }






    function create_meeting(Request $request)
    {

          // dd($request);
        $request['start_time']  =$request['start_time'].":00" ;
        //dd($request);

        $input=$request->all();

        $client2=new \GuzzleHttp\Client();
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        //      $client->request('get','/oauth/authorize?response_type=code&client_id=Z4uZETY8RKOqVztN9mOG6A&redirect_uri=https://esraa.azq1.com/nhlzoom/auth');*/
        $arr_token = json_decode(\App\Token::where('user_id',auth()->user()->id)->first()->access_token);
        $accessToken = $arr_token->access_token;
        // return $accessToken;



        //try {
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ],
            'json' => [
                "topic" => $input['topic'],
                //"type" => 2,
                "start_time" =>$request['start_time'],
                'agenda'=>$input['agenda'],
                'password'=>$request->password,
                "duration" => $input['duration'], // 30 mins
                'settings'=>['waiting_room'=>$request->waiting_room=='on'?1:0,'host_video'=>Request()->option_video_host=='on'?true:false,'participant_video'=>Request()->option_video_participants=='on'?true:false,'mute_upon_entry'=>Request()->option_mute_upon_entry=='on'?true:false,
                    'join_before_host'=>Request()->option_jbh=='on'?true:false,'auto_recording'=>Request()->option_autorec]
                //"password" => "123456"
            ],
        ]);



        $data = json_decode($response->getBody());
$check=strpos($data->start_url, '?');
$check2=strpos($data->join_url, '?');
          $request['start_time'] =  str_replace('T', ' ', $request['start_time'] );
        $stream= Streaming::create(['course_id'=>$input['course_id'],'super_id'=>auth()->user()->id,'class_id'=>$data->id,'start_time'=>$request['start_time'],'presenter_url'=>$check?explode('?',$data->start_url)[0]:$data->start_url,'duration'=>$data->duration,'status'=>$data->status,'flag'=>1,'join_url'=>$check2?explode('?',$data->join_url)[0]:$data->join_url,'topic'=>$data->topic,'host_video' => Request()->option_video_host == 'on' ? true : false, 'participant_video' => Request()->option_video_participants == 'on' ? true : false, 'mute_upon_entry' => Request()->option_mute_upon_entry == 'on' ? true : false,
            'agenda'=>$input['agenda'], 'waiting_room'=>$request->waiting_room=='on'?1:0,'password'=>$request->password, 'join_before_host' => Request()->option_jbh == 'on' ? true : false, 'auto_recording' => Request()->option_autorec]);

        $course=Course::find($input['course_id']);
       

    }

    public function update_meeting(Request $request,$id){
        $rules =[
            'start_time'       	     => ['required','after_or_equal:'.date("Y-m-d HH:mm:ss")],
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            //	echo dd($validate->messages());
            return redirect()->back()->withInput()->with('toast_error', $validate->messages()->all());
        }

        $request['start_time']  =$request['start_time'].":00" ;
        // dd($request);
        $input=$request->all();
//dd($input['start_time'].":00");
        //    return   $request['start_time'];
        $client2=new \GuzzleHttp\Client();
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        //      $client->request('get','/oauth/authorize?response_type=code&client_id=Z4uZETY8RKOqVztN9mOG6A&redirect_uri=https://esraa.azq1.com/nhlzoom/auth');*/
        $arr_token = json_decode(\App\Token::where('user_id',auth()->user()->id) ->first()->access_token);
        $accessToken = $arr_token->access_token;
        // return $accessToken;
//dd($id);

        try {
            //  dd('dfsd');
            $response = $client->request('PATCH', '/v2/meetings/'.$id, [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
                'json' => [
                    "topic" => $input['topic'],
                    //"type" => 2,
                    "start_time" => $request['start_time'],
                    'agenda' => $input['agenda'],
                    'password'=>$request->password,
                    "duration" => $input['duration'], // 30 mins
                    'settings' => ['waiting_room'=>$request->waiting_room=='on'?1:0,'host_video' => Request()->option_video_host == 'on' ? true : false, 'participant_video' => Request()->option_video_participants == 'on' ? true : false, 'mute_upon_entry' => Request()->option_mute_upon_entry == 'on' ? true : false,
                        'join_before_host' => Request()->option_jbh == 'on' ? true : false, 'auto_recording' => Request()->option_autorec]
                    //"password" => "123456"
                ],
            ]);

            $data = json_decode($response->getBody());

            //   dd($data);

             $request['start_time'] =  str_replace('T', ' ', $request['start_time'] );
            $stream = Streaming::where('class_id',$id)->first()->update(['start_time'=>$request['start_time'] ,'duration'=>$input['duration'],'flag'=>1,'topic'=>$input['topic'],'host_video' => Request()->option_video_host == 'on' ? true : false, 'participant_video' => Request()->option_video_participants == 'on' ? true : false, 'mute_upon_entry' => Request()->option_mute_upon_entry == 'on' ? true : false,
                'agenda'=>$input['agenda'],'password'=>$request->password,  'join_before_host' => Request()->option_jbh == 'on' ? true : false, 'auto_recording' => Request()->option_autorec]);


//dd('iyuik');
        }catch(\Exception $e){
            return redirect()->back()->withInput()->with('toast_error','هناك خطأ');
        }
        return redirect()->route('home');
    }




}
//crete_meeting();

