<?php

namespace App\Http\Controllers;

use App\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::all();
        return view('faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->all();
        $validator = Validator::make($data,array(
            'question'         => 'required',
            'answer'         => 'required',
        ));
        if ($validator->fails()) {
            return redirect()->back();
        }else{
        $faq = new FAQ();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        }
        return redirect('faqs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FAQ::where('id',$id)->first();
		return view('faqs.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$data = $request->all();
        $validator = Validator::make($data,array(
            'question'=> 'required',
            'answer'=>'required'
        ));
        if ($validator->fails()) {
            return redirect()->back();
        }
        else{
			$faq = FAQ::where('id',$id)->first();
			$faq->question = $request->question;
			$faq->answer = $request->answer;
			$faq->save();
            return redirect('faqs')->with('success','FAQ has successfully updated');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = FAQ::where('id',$id)->delete();
			if($data != '' || $data != null)
			{
				echo 1;exit;
			}else{

			echo 0;exit;
			}
          return redirect('faqs')->with('success','FAQ has successfully deleted');
    }

    public function deleteAllFAQs($allids){
        $allids = explode(',', $allids);
        FAQ::whereIn('id',$allids)->delete();
    }
}
