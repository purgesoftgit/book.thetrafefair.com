<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use App\ContactUs;
use App\Event;
use App\Artefact;
use Illuminate\Support\Facades\Validator;
use App\EventRequest;

class HomeController extends Controller
{
    public function index(){
        $data = Home::all();
        $artefact = Artefact::all();
        return view('index',compact('data','artefact'));
    }

    public function contactStore(Request $request){
       
        
        $validator = Validator::make($request->all(), [
            'name' => ['required','regex:/^[a-zA-Z\s]+$/','min:3'],
            'email' => ['required','email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'phone' => ['required','numeric'],
            'message' => ['required'],
            'g-recaptcha-response' => 'required',
        ]);
 
        if( $validator->fails()){
            return redirect()->back()->withError($validator);    
        }
      
        $data = new ContactUs;
        $data->selected_website = 1; //1 for thetradefair
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->message = $request->message;
        $data->status = 'Unread';
        $data->save();
 
        return redirect('/')->with(['status'=>200,'message'=>"Your request is in processing."]);
        // return response()->json(['message' => 'Data saved successfully']);
    }

    public function event(){

        $event = Event::all();
        
        return view('events.event',compact('event'));
    }

    public function eventStore(Request $request){

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'guest_number' => ['required','numeric'],
            'start_date' => ['required','date','after_or_equal:today'],
            'end_date'=> ['required','date','after_or_equal:today'],
            'full_name'=>['required','regex:/^[a-zA-Z\s]+$/','min:3'],
            'phone'=>['required','numeric'],
            'email'=>['required','email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
        ]);


        if( $validator->fails()){
            return redirect()->back()->withError($validator);    
        }
 
        
        $bookEvent = new EventRequest;
        $bookEvent->hotel = $request->hotel;
        $bookEvent->event_name = $request->event_name;
        $bookEvent->guest_number = $request->guest_number;
        $bookEvent->start_date = $request->start_date;
        $bookEvent->end_date = $request->end_date;
        $bookEvent->seating_style = $request->exampleRadios;
        $bookEvent->full_name = $request->full_name;
        $bookEvent->phone = $request->phone;
        $bookEvent->email = $request->email;
        $bookEvent->save();

        return redirect('/')->with(['status'=>200,'message'=>"Your request for booking has been sent."]);
    }

    public function eventDetail($slug) {
        $event_detail = Event::where('slug', $slug)->first();
        $latest_event = Event::where('id','!=',$event_detail->id)->orderBy('id', 'desc')->limit(10)->get();

        return view('events.event-detail',compact('event_detail','latest_event'));
    } 
}
