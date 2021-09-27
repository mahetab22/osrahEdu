<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;
use App\HTTP\Controllers\Controller;
use App\Http\Requests\Admin\ServicesRequest;
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
use DB;
use Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $input = [
            'services' => Service::get(),
            'info' => DB::table('infos')->first()
          ];

          return view('admin.services.index',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesRequest $request)
    {
        //
        $service = new Service;
        $service->title_ar = $request->title_ar;
        $service->title_en = $request->title_en;
        $service->description_ar = $request->desc_ar;
        $service->description_en = $request->desc_en;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/service', $imageName);
            $service->logo = 'public/storage/service/'. $imageName;
        }

        $service->save();

        return redirect('admin/services')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.service add successfully'),
            ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $input = [
            'service' => Service::find($id),
        ];

        return view('admin.services.show',$input);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $input = [
            'service' => Service::find($id),
            'roles' => UserRole::all(),
        ];
        return view('admin.services.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServicesRequest $request, $id)
    {
        //

        $service = Service::find($id);
        $service->title_ar = $request->title_ar;
        $service->title_en = $request->title_en;
        $service->description_ar = $request->desc_ar;
        $service->description_en = $request->desc_en;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/service', $imageName);
            $service->logo = 'public/storage/service/'. $imageName;
        }

        $service->save();

        return redirect('admin/services')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.service add successfully'),
            ]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $service=Service::find($id);
        if(!is_null($service)){
            $service->delete();
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

        try{
            if (is_array($request->ids)){
                Service::destroy($request->ids);
            }else{
                $service=Service::find($request->ids);
                $service->delete();
            }
            return response()->json(['err'=>'0','alert' =>[
                'icon'=>'success',
                'title'=>__('site.alert_success'),
                'text'=>__('site.deleted_successfully')
                ]]);

        } catch(Exception $e) {

            return response()->json(['err'=>'1','alert' =>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.deleted_failed')
                ]]);
        }
    }
}
