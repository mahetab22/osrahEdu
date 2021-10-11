<?php

namespace App\Http\Controllers\Admin;

use App\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BreadcrumbRequest;
use Illuminate\Http\Request;

class BreadcrumbController extends Controller
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
            'breadcrumbs'=>Breadcrumb::all(),
        ];

        return view('admin.breadcrumb.index',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.breadcrumb.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BreadcrumbRequest $request)
    {
        //
    try {
        $breadcrumb = new Breadcrumb;
        $breadcrumb->title_ar = $request->title_ar;
        $breadcrumb->title_en = $request->title_en ?? $request->title_ar;
        $breadcrumb->url = $request->link_url;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/breadcrumbs',$imageName);
            $breadcrumb->image = 'public/storage/breadcrumbs/'. $imageName;
        }
        $breadcrumb->save();

    } catch(Exception $e) {
        return redirect()->back()->with([
            'alert'=>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.failed to add breadcrumb image'),
            ]]);
    }

    return redirect('admin/breadcrumbs')->with([
        'alert'=>[
            'icon'=>'success',
            'title'=>__('site.done'),
            'text'=>__('site.breadcrumb added successfully'),
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
        $input = [
            'breadcrumb' => Breadcrumb::find($id)
        ];

        return view('admin.breadcrumb.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BreadcrumbRequest $request, $id)
    {
        //
        try {
            $breadcrumb = Breadcrumb::find($id);
            $breadcrumb->title_ar = $request->title_ar;
            $breadcrumb->title_en = $request->title_en ?? $request->title_ar;
            $breadcrumb->url = $request->link_url;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = time() . rand(10, 10000) . '.' . $image->extension();
                $image->move(public_path().'/storage/breadcrumbs',$imageName);
                $breadcrumb->image = 'public/storage/breadcrumbs/'. $imageName;
            }
            $breadcrumb->save();

        } catch(Exception $e) {
            return redirect()->back()->with([
                'alert'=>[
                    'icon'=>'error',
                    'title'=>__('site.alert_failed'),
                    'text'=>__('site.failed to update breadcrumb image'),
                ]]);
        }

        return redirect('admin/breadcrumbs')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.breadcrumb updated successfully'),
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
        $breadcrumb=Breadcrumb::find($id);
        if(!is_null($breadcrumb)){
            $breadcrumb->delete();
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
