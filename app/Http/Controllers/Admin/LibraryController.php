<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LibraryRequest;
use App\Library;
use Illuminate\Http\Request;


class LibraryController extends Controller
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
            'books' => Library::all()
        ];

        return view('admin.library.index',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.library.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibraryRequest $request)
    {
        // dd($request);
        //
        $book = new Library;
        $book->title = $request->title;
        $book->desc= $request->short_desc;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/books/images', $imageName);
            $book->image = 'public/storage/books/images/'. $imageName;
        }
    
        $pdf = $request->file('pdf');
        // if($pdf->getClientSize() <= 10240){
            $pdf->extension();
            $pdfName = time() . rand(10, 10000) . '.' . $pdf->extension();
            $pdf->move(public_path().'/storage/books/pdf', $pdfName);
            $book->pdf = 'public/storage/books/pdf/'. $pdfName;
        // }else{
        //     return redirect('admin/library')->with([
        //         'alert'=>[
        //             'icon'=>'warning',
        //             'title'=>__('site.warning'),
        //             'text'=>__('site.pdf max'),
        //         ]]);  
        // }

        $book->save();

        return redirect('admin/library')->with([
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
        $book=Library::find($id);
        return view('admin.library.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LibraryRequest $request, $id)
    {
        //
        $book = Library::find($id);
        $book->title = $request->title;
        $book->desc= $request->short_desc;

        if ($request->hasFile('image')) {
            $filename = $book->image;
            if (file_exists($filename)) {
              unlink($filename);
            }
            $image = $request->file('image');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/books/images', $imageName);
            $book->image = 'public/storage/books/images/'. $imageName;
        }

        if ($request->hasFile('pdf')) {
            $filename = $book->pdf;
            if (file_exists($filename)) {
              unlink($filename);
            }
            $pdf = $request->file('pdf');
            // if($pdf->getClientSize() <= 10240){
                $pdf->extension();
                $pdfName = time() . rand(10, 10000) . '.' . $pdf->extension();
                $pdf->move(public_path().'/storage/books/pdf', $pdfName);
                $book->pdf = 'public/storage/books/pdf/'. $pdfName;
            // }else{
            //     return redirect('admin/library')->with([
            //         'alert'=>[
            //             'icon'=>'warning',
            //             'title'=>__('site.warning'),
            //             'text'=>__('site.pdf max'),
            //         ]]);  
            // }
        }

        $book->save();

        return redirect('admin/library')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.added successfully'),
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
        $lib=Library::find($id);
        if(!is_null($lib)){
            $filename = $lib->image;
            $pdf=$lib->pdf;
            if (file_exists($filename)) {
              unlink($filename);
            }
            if (file_exists($pdf)) {
                unlink($pdf);
              }
            $lib->delete();
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
               $library= Library::whereIn('id',$request->ids)->get();
               foreach($library as $lib){
                $filename = $lib->image;
                $pdf=$lib->pdf;
                if (file_exists($filename)) {
                  unlink($filename);
                }
                if (file_exists($pdf)) {
                    unlink($pdf);
                  } 
                 $lib->delete();  
            }
            }else{
                $lib=Library::find($request->ids);
               
                    $filename = $lib->image;
                    $pdf=$lib->pdf;
                    if (file_exists($filename)) {
                      unlink($filename);
                    }
                    if (file_exists($pdf)) {
                        unlink($pdf);
                      }   
                
                $lib->delete();
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
