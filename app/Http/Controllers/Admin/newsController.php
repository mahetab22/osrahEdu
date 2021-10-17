<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use Illuminate\Http\Request;

Use Alert;
Use Visitor;
use App\News;
use Session;
use DB;
use Validator;

class newsController extends Controller
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
            'news' => News::get(),
           
          ];

          return view('admin.news.index',$input);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
       return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        //
        $news=new News;
        $news->title=$request['title'];
        $news->short_desc=$request['short_desc'];
        $news->desc=$request['desc'];  
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/news', $imageName);
            $news->logo = 'public/storage/news/'. $imageName;
        }

        $news->save();

        return redirect('admin/news')->with([
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
        //
     
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
        $new=News::find($id);
      return view('admin.news.edit',compact('new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $news=News::find($id);
        $news->title=$request['title'];
        $news->short_desc=$request['short_desc'];
        $news->desc=$request['desc'];  
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/news', $imageName);
            $news->logo = 'public/storage/news/'. $imageName;
        }

        $news->save();
        return redirect('admin/news')->with([
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
        $new=News::find($id);
        if(!is_null($new)){
            $new->delete();
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
                News::destroy($request->ids);
            }else{
                $new=News::find($request->ids);
                $new->delete();
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
