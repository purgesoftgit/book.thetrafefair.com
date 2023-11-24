@extends('layouts.dashboard-layout')
@section('content')

 <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" href="#">
      <i class="fas fa-bars"></i>
    </a>
  <!--Navbar Start-->
   @include('dashboard.navbar')
  <!--EndNavbar Start-->

   <!-- sidebar-wrapper  -->
    <main class="page-content">
        
      <!-- top bar -->
     @include('dashboard.header')
      <div class="midsection">
        <div class="container-fluid">
  <div class="row ">
      <!-- <div class="col-md-2 col-lg-2">
                &nbsp;
                </div> -->
         <div class="col-lg-12 col-xl-12">          
              <div class="whbox formbox">
                            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item">/</li>
                <li class="breadcrumb-item"><a href="{{url('faqs')}}">FAQs</a></li>
                <li class="breadcrumb-item">/</li>
                <li class="breadcrumb-item active" aria-current="page">Edit FAQ</li>
              </ol>
            </nav>
            <div class="clearfix"><hr/></div>
            <div class="clearfix">&nbsp;</div>

               <div class="row pagetop-title">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7"><h3>Edit FAQ</h3></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 add-blogpost-right">
                <button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button></div>
              </div>

              <br>

                <form method="POST" action="{{ url('faqs').'/'.$data->id}}}" id="faq_form">
                   @csrf
                   @method('PUT')
        
                    <div class="row">
                        <div class="col-md-12">
                        {{-- <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}"> --}}
                            <label>Question</label>
                            <input type="text"  name="question" id="question" value="{{$data->question}}" class="form-control" placeholder="Question">
                            <span class="question-text error"></span>
                            {{-- @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif                         --}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                          {{-- <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}"> --}}
                            <label>Answer</label>
                            <textarea name="answer" id="answer">{{$data->answer}}</textarea>
                             <span class="answer-text error"></span>
                              {{-- @if ($errors->has('description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif   --}}
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                          <button type="submit" id="addnews" class="btn btn-primary">Update</button>
                          <a href="{{url('faqs')}}" class="btn btn-primary cancel-button">Cancel</a>
                        </div>
                    </div>
              </form>
              </div>
            </div>            
            
      </div>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
 <script> 
    $(document).ready(function(){
      CKEDITOR.replace( 'answer' );
        $("#faq_form").validate({
             rules:{
              question: "required",
              answer: "required",
            },
            messages: {
                question: "Title is required.",
                answer: "Description is required.",
            },
          submitHandler: function(form) {
            if(CKEDITOR.instances.description.getData() != '')
              form.submit();
            else{
              $(".answer-text").text("Answer is required")
            }
          }
         });
    });
  </script>
@endsection
