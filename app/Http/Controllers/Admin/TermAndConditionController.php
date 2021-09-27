<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TermAndCondition;
use App\Http\Requests\Admin\TermsRequest;
use Illuminate\Http\Request;

class TermAndConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $input =
        [
            'terms' => TermAndCondition::all(),
        ];
        return view('admin.terms.index',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.terms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TermsRequest $request)
    {
        //

        $terms = new TermAndCondition;
        $terms->title_ar = $request->title_ar;
        // $terms->title_en = $request->title_en;
        $terms->terms_ar = $request->terms_ar;
        // $terms->terms_en = $request->terms_ar;
        $terms->save();

        return redirect('admin/terms')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.terms add successfully'),
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
            'term' => TermAndCondition::find($id),
        ];
        return view('admin.terms.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $terms = TermAndCondition::find($id);
        $terms->title_ar = $request->title_ar;
        // $terms->title_en = $request->title_en;
        $terms->terms_ar = $request->terms_ar;
        // $terms->terms_en = $request->terms_ar;
        $terms->save();

        return redirect('admin/terms')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.terms updated successfully'),
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
        $term= TermAndCondition::find($id);
        if(!is_null($term)){
            $term->delete();
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
                TermAndCondition::destroy($request->ids);
            }else{
                $term=TermAndCondition::find($request->ids);
                $term->delete();
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
