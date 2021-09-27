<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;
use App\HTTP\Controllers\Controller;
use App\Http\Requests\Admin\saidAboutUsRequest;
use Illuminate\Http\Request;
use App\Department;
Use Alert;
use App\SaidAboutUs;
use Session;
use DB;
use Validator;

class saidAboutUsController extends Controller
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
            'aboutes' => SaidAboutUs::get(),
          ];

          return view('admin.saidAboutUs.index',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.saidAboutUs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(saidAboutUsRequest $request)
    {
        //
        $about = new SaidAboutUs;
        $about->username = $request->username;
        $about->job = $request->job;
        $about->comment = $request->comment;
        $about->rate = $request->rate;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/saidAboutUs', $imageName);
            $about->photo = 'public/storage/saidAboutUs/'. $imageName;
        }
        $about->save();

        return redirect('admin/said/about/us')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.added successfully'),
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
            'about' => SaidAboutUs::find($id),
        ];
        return view('admin.saidAboutUs.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(saidAboutUsRequest $request, $id)
    {
        //

        $about = SaidAboutUs::find($id);
        $about->username = $request->username;
        $about->job = $request->job;
        $about->comment = $request->comment;
        $about->rate = $request->rate;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/saidAboutUs', $imageName);
            $about->photo = 'public/storage/saidAboutUs/'. $imageName;
        }


        $about->save();

        return redirect('admin/said/about/us')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.updated successfully'),
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
        $about=SaidAboutUs::find($id);
        if(!is_null($about)){
            $about->delete();
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
                SaidAboutUs::destroy($request->ids);
            }else{
                $about=SaidAboutUs::find($request->ids);
                $about->delete();
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
