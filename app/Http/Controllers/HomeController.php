<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\ContactUs;
use App\Event;
use App\Artefact;
use Illuminate\Support\Facades\Validator;
use App\EventRequest;

class HomeController extends Controller
{
    public function index(){
      
        return view('index');
    }

   
}
