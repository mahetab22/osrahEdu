<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;
use App\HTTP\Controllers\Controller;
use App\Http\Requests\Admin\UsersRequest;
use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Condition;
use App\Course;
use App\User;
Use Alert;
Use Visitor;
use App\MarketeInfo;
use App\Models\Info;
use App\UserRole;
use Session;
use Validator;
use Hash;
use DB;
class userController extends Controller
{

    public function index(){
    $users=User::get();
    $info = DB::table('infos')->first();
    return view('admin.users.index',compact('users','info'));
    }


    public function userActive(Request $request){
        $user=User::find($request['id']);
        $user->s=1;
        $user->save();
        return $user->s;
    }

    public function create(){
        $input = [
            'roles' => UserRole::all(),
        ];
        return view('admin.users.create',$input);
    }

    public function store(UsersRequest $request){

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->gender = $request->gender;
        $user->Age = $request->age;
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/users', $imageName);
            $user->avatar = 'storage/users/'. $imageName;
        }
        $user->save();

        return redirect('admin/users')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>'تم',
                'text'=>'تم إضافة المستخدم بنجاح',
            ]]);

    }

    public function show($id){

    }


    public function edit($id){
        $input = [
            'user'=>User::find($id),
            'roles' => UserRole::all(),
        ];
        return view('admin.users.edit',$input);
    }

    public function update($id,UsersRequest $request){

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password != Null  ? Hash::make($request->password) : $user->password ;
        $user->role_id = $request->role;
        $user->gender = $request->gender;
        $user->Age = $request->age;
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/users', $imageName);
            $user->avatar = 'storage/users/'. $imageName;
        }
        $user->save();

        return redirect('admin/users')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>'تم',
                'text'=>'تم تعديل بيانات الخدمة بنجاح',
            ]]);

    }

    public function user_active(Request $request){
    $user=User::find($request['id']);
    if($user->s==0){
    $user->s=1;
    }else{
      $user->s=0;
    }
    $user->save();
    return $user->s;
  }
    public function destroy($id){

        $user=User::find($id);
        if(!is_null($user)){
            $user->delete();
            return response()->json(['err'=>'0','alert' =>[
                'icon'=>'success',
                'title'=>__('site.alert_success'),
                'text'=>__('site.deleted_successfully')
                ]]);
        }else{
            return response()->json(['err'=>'1','alert' =>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.deleted_failed')
                ]]);
        }

    }

    public function delete_all(Request $request){

        if (is_array($request->ids)){
            $array_diff = array_diff($request->ids, ['1']);
            User::destroy($array_diff);
            return response()->json(['err'=>'0','alert' =>[
                'icon'=>'success',
                'title'=>__('site.alert_success'),
                'text'=>__('site.deleted_successfully')
                ]]);
        }else{
            return response()->json(['err'=>'1','alert' =>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.deleted_failed')
                ]]);
        }
    }
}
