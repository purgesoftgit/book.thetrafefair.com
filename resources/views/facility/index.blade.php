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

          <div class="row">
            <!-- <div class="col-md-2 col-lg-2">&nbsp;</div> -->
            <div class="col-lg-12 col-xl-12">
              <div class="row rightgape">
            <div class="col-lg-12">          
              <div class="whbox">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('get-upcoming-checkin-checkout')}}">Home</a></li>
                <li class="breadcrumb-item">/</li>
                <li class="breadcrumb-item active" aria-current="page">Facility</li>
              </ol>
            </nav>
            <div class="clearfix"><hr/></div>
             {{-- @if ($message = Session::get('success'))
           <div class="alert alert-success alert-dismissible fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{$message}}
          </div>
              @endif --}}
            <div class="clearfix">&nbsp;</div>

                <div class="row pagetop-title">
                  <div class="col-lg-6 col-md-4 col-sm-4"><h3>Facility</h3></div>
                  <div class="col-lg-6 col-md-8 col-sm-8 add-blogpost-right">
                  <a href="{{url('facility/create')}}" class="btn btn-primary">Add FAcility</a>
                  <button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button></div>
                </div>

                <br>
                
                <div class="row">
                  <div class="col-lg-6"> </div>
                </div>
                  <div class="row rightgape">
                    <div class="col-lg-12">          
                      <div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="table-responsive">
                              <table class="table table-striped medium-table" id="myTable">
                                <thead>
                                <tr>
                                  <th ><input name="select_all" value="1" type="checkbox"></th>
                                  <th width="8%" class="d-none"></th>
                                  <th width="15%">Title</th>
                                  <th width="15%">Image</th>
                                  <th width="40%">Tags</th>
                                  <th width="20%">Action</th>
                                <!--   <th>Share Action</th> -->
                                </tr>
                            </thead>

                            <tbody>
                              @if(count($facility) == 0)
                              <tr>
                                <td colspan="7"><h6 class="text-center">FAQs not available.</h6></td>
                              </tr>
                              @else
                                 @foreach($facility as $key => $d)
                                <tr>
                                  <td></td>
                                  <td class="d-none">{{$d->id}}</td>
                                  
                                  <td style="vertical-align: top" >{{$d->title}}</td>
                                  <td style="vertical-align: top" ><img src="{{ asset('images/'.$d->image) }}" /></td>
                                  <td style="vertical-align: top" >{!! \Illuminate\Support\Str::limit($d->data, $limit = 100, $end = '...')!!}</td>
                                  <td style="vertical-align: top" >
                                    <a href="{{url('facility').'/'.$d->id}}"class="edit-icon"><i class="far fa-eye"></i> </a>
                                    <a href="{{url('facility').'/'.$d->id.'/edit'}}"class="edit-icon"><i class="far fa-edit"></i> </a>
                                    <a class="delete-button del-icon"  id='del_<?= $d->id ?>' data-id='<?= $d->id ?>' style="cursor: pointer;"><i class="far fa-trash-alt"></i></a> 
                                  </td>
                               
                                </tr>
                                @endforeach
                               
                                @endif
                            </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
              </div>
            </div>
          </div>
              <!-- Client Section End -->
          <div class="d-none append-all-ids"></div>
        </div>
      </div>
    </div>
  </div>
  </main>
</div>
<script type="text/javascript">
$(document).ready(function(){

     $('.delete-button').click(function(){
      var el = this;
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url:'{{ url("facility") }}/'+$(this).data('id'),
            type:'delete',
            data: {
               "_token": "{{ csrf_token() }}",
            },
            success:function(response){
             $(el).closest('tr').css('background','tomato');
             $(el).closest('tr').fadeOut(800,function(){
               $(this).remove();
             });
            }
          });
        }
      })
    });
});
</script>
<!-- page-content" -->
@endsection