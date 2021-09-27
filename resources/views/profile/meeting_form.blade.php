<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('public/src_website/css/main.css') }}" rel="stylesheet" type="text/css" />


</head>
<body>

<div class="container">
    <h3 style="padding-bottom: 10px;"><span>Schedule a Meeting</span></h3>
    <form method="post"  class="zoom-form" @if(isset($stream)) action="{{route('update_meeting',$stream->class_id)}}" @else action="{{route('create_meeting')}}" @endif>

@csrf
        <div class="form-group">
            <div class="row">
                <label class="meeting-label col-md-2" for="topic">Topic</label>
                <div class="controls col-md-5">
                    <input type="text" id="topic" name="topic" maxlength="200" @if(isset($stream)) value="{{$stream->topic}}" @endif class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="meeting-label col-md-2" for="agenda">Description (Optional)</label>
                <div class="controls col-md-5">
                    <textarea class="sch-desc form-control" id="agenda" name="agenda" maxlength="2000" placeholder="Enter your meeting description">@if(isset($stream))   {{$stream->agenda}} @endif  </textarea>
                </div>
            </div>
        </div>
        <hr/>

        <div class="form-group">
            <div class="row">
                <label class="meeting-label col-md-2" for="start_time">Start time</label>
                <div class="controls col-md-5">
                    <input type="datetime-local" placeholder="@lang('site.start_time')" name="start_time" @if(isset($stream))  value="{{$date}}" @endif id="datepicker" class="form-control datepicker" required=""/>

                </div>
            </div>
        </div>















            <div class="form-group ">
                <label class="meeting-label col-md-2">Security</label>
                <div class="controls col-md-10" id="security-option">
                    <div style="display:inline-block;margin-right: 25px;">
                        <label class="checkbox-inline" for="option_password"><input type="checkbox" @if(isset($stream)) @if(isset($stream->password))   checked @endif @endif id="option_password" name="option_password">Passcode</label>
                        <div style="display: inline-block;"><label for="meeting_pass" id="passwordLabel" style="display: inline; margin-bottom: 0px;"><span class="sr-only">Passcode</span></label> <input type="text" id="meeting_pass" name="password"   @if(isset($stream)) @if(isset($stream->password)) value="{{$stream->password}}"  @endif @endif placeholder="Enter Passcode" maxlength="10" autocomplete="off" class="form-control hideme" style="display: inline-block;" aria-describedby="meetingPassTipsAudio" aria-invalid="false"></div>
                    </div>
                    <label class="checkbox" for="option_waiting_room">
                        <input type="checkbox" class="m_option_chk" id="option_waiting_room"  @if(isset($stream)) @if(isset($stream->waiting_room))   checked @endif @endif  name="waiting_room">
                        Waiting Room</label>
                    <div>
<span id="passwordErrorTips" role="alert" style="display:none; padding-left: 20px; color: #DE2828">
Passcode does not meet requirements</span>
                        <span id="weakPasswordDetectionTips" role="alert" style="display:none; padding-left: 20px; color: #DE2828">
Enter a stronger passcode</span>
                    </div>
                    <span id="error_password" style="display:none;" class="has-error help-block"></span>
                    <p id="error_security" class="has-error" role="alert" style="display: none;">
                        <span class="help-block">You must select one or both of these options</span>
                    </p>
                </div>
            </div>

        <div class="form-group">
            <div class="row">
                <label class="meeting-label col-md-2" for="agenda">Duration</label>
                <div class="controls col-md-5">
                    <input type="number" id="duration" name="duration"  @if(isset($stream))  value="{{$stream->duration}}" @endif class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="control-label col-md-2">&nbsp;</div>
                <div class="controls col-md-10">

                </div>
            </div>
        </div>
        <div class="form-group">

        </div>

        <div class="form-group">
            <div class="row">
                <label class="meeting-label col-md-2" id="host_video">Video</label>
                <div class="controls col-md-10">
                    <div class="row">
                        <label id="host_video_text" class="meeting-label col-md-2"title="Start host's video automatically when join meeting.">Host</label>
                        <div role="radiogroup" aria-labelledby="host_video">
                            <label class="radio" id="option_video_host_on_txt" for="option_video_host_on">
                                <input type="radio" id="option_video_host_on" name="option_video_host" value="on" @if(isset($stream)) @if($stream->host_video==1)   checked="checked" @endif @endif>on
                            </label>
                            <label class="radio" id="option_video_host_off_txt" for="option_video_host_off">
                                <input type="radio" id="option_video_host_off" name="option_video_host" @if(isset($stream)) @if($stream->host_video==0)   checked="checked" @endif @endif value="off">off
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="meeting-label col-md-2" id="participant_video"></label>
                <div class="controls col-md-10">
                    <div class="row">
                        <label id="participant_video_text" class="meeting-label col-md-2" title="Start participants' video automatically when join meeting.">Participant</label>
                        <div role="radiogroup" aria-labelledby="participant_video">
                            <label aria-labelledby="host_video participant_video_text option_video_participant_on_txt" class="radio" id="option_video_participant_on_txt" for="option_video_participant_on">
                                <input type="radio" id="option_video_participant_on" name="option_video_participants" value="on"  @if(isset($stream)) @if($stream->video_participant==1)   checked="checked" @endif @endif >on
                            </label>
                            <label aria-labelledby="host_video participant_video_text option_video_participant_off_txt" class="radio" id="option_video_participant_off_txt" for="option_video_participant_off">
                                <input type="radio" id="option_video_participant_off" name="option_video_participants"  @if(isset($stream)) @if($stream->video_participant==0)   checked="checked" @endif @endif value="off">off
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <fieldset>
                <legend class="options-legend">
                    <div class="meeting-label col-md-2" style="padding-left: 0px">Meeting Options</div>
                </legend>
                <div class="form-group">
                    <div class="row">
                        <div class="meeting-label col-md-2"></div>
                        <div class="controls col-md-5">
                            <label class="checkbox" for="option_jbh" style="display:inline-block;">
                                <input type="checkbox" id="option_jbh"   @if(isset($stream)) @if($stream->join_before_host==1)   checked="checked" @endif @endif name="option_jbh">Enable join before host
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="meeting-label col-md-2"></div>
                        <div class="controls col-md-5">
                            <label class="checkbox" for="option_mute_upon_entry">
                                <input type="checkbox" class="m_option_chk" id="option_mute_upon_entry" @if(isset($stream)) @if($stream->mute_upon_entry==1)   checked="checked" @endif @endif name="option_mute_upon_entry">Mute participants upon entry
                            </label>
                        </div>
                    </div>
                </div>
                <input name="course_id" value="{{ $course->id }}" hidden="" >

                <div class="form-group" id="meet-autorec">
                    <div class="row">
                        <div class="meeting-label col-md-2"></div>
                        <div class="controls col-md-10">
                            <label class="checkbox" for="option_autorec">
                                <input type="radio" id="option_autorec"  @if(isset($stream)) @if($stream->auto_recording=='local')   checked="checked" @endif @endif   value="local" name="option_autorec">
                                <span>Record the meeting automatically on the local computer</span>
                                <br>
                                <input type="radio" id="option_autorec"   @if(isset($stream)) @if($stream->auto_recording=='cloud')   checked="checked" @endif @endif  value="cloud" name="option_autorec">
                                <span>Record the meeting automatically on the cloud</span>
                            </label>
                        </div>
                    </div>
                </div>

            </fieldset>
            <div class="form-group submit-buttonsa">
                <div class="row">
                    <div class="meeting-label col-md-2"></div>
                    <div class="controls col-md-10">
                        <button class="btn btn-primary btn-lg submit">Save</button>
                       {{-- <a role="button" class="btn btn-default btn-lg" href="#">Cancel</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


   <script>
       console.log( $('#datepicker').val() )
   </script>


</body>
</html>
