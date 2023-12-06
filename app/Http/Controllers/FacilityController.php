<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookingEngineFacility;

use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facility = BookingEngineFacility::all();
        return view('facility.index', compact('facility'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facility.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif',
            'data' => 'required',
        ]);

       $data = new BookingEngineFacility();
       $data->title = $request->title;
       $data->data = $request->data;    
       if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = uniqid() .'.'. $image->getClientOriginalExtension();
            $data->image = $extention;
            $image->storeAs('images', $extention, 'public');
        }
       $data->save();

       return redirect('facility');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = BookingEngineFacility::where('id',$id)->first();
		return view('facility.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = BookingEngineFacility::where('id',$id)->first();
		return view('facility.edit',compact('data'));
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
        $data = $request->all();
        $validator = Validator::make($data,array(
            'title' => 'required|string|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif',
            'data' => 'required',
        ));
            if ($validator->fails()) {
                return redirect()->back();
            }
            else{
                $data = BookingEngineFacility::where('id',$id)->first();
                $data->title = $request->title;
            $data->data = $request->data;    
            if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $extention = uniqid() .'.'. $image->getClientOriginalExtension();
                    $data->image = $extention;
                    $image->storeAs('images', $extention, 'public');
                }
            $data->save();

        return redirect('facility')->with('success','Facility has successfully updated');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BookingEngineFacility::where('id',$id)->delete();
			if($data != '' || $data != null)
			{
				echo 1;exit;
			}else{

			echo 0;exit;
			}
          return redirect('facility')->with('success','Facility has successfully deleted');
    }
}
