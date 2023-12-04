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
          <div class="col-lg-12 col-xl-12">
            <div class="row rightgape">
              <div class="col-lg-12">
                <div class="whbox">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('get-upcoming-checkin-checkout')}}">Home</a></li>
                      <li class="breadcrumb-item">/</li>
                      <li class="breadcrumb-item active" aria-current="page">Newsletters</li>
                    </ol>
                  </nav>
                  <div class="clearfix">
                    <hr />
                  </div>

                  <div class="clearfix">&nbsp;</div>

                  <div class="row pagetop-title">
                    <div class="col-lg-6 col-md-4 col-sm-4">
                      <h3>NewsLetters</h3>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-8 add-blogpost-right">
                      <button class="btn btn-dark" onclick="window.history.back();"><i class="fa fa-arrow-left"></i> Back</button>
                    </div>
                  </div>
                  <br>




                  <div class="row rightgape">
                    <div class="col-lg-12">

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                            <table class="table table-striped medium-table" id="myTable">
                              <thead>
                                <tr>
                                  <th ><input name="select_all" value="1" type="checkbox"></th>
                                  <th width="18%" class="d-none"></th>
                                  <th width="60%">Email</th>
                                  <th width="20%">Action</th>
                                </tr>
                              </thead>

                              <tbody>
                                @if(count($newsletters) == 0)
                                <tr>
                                  <td colspan="7">
                                    <h6 class="text-center">Newsletters not available.</h6>
                                  </td>
                                </tr>
                                @else
                                @foreach($newsletters as $key => $d)
                                <tr>
                                  <td></td>
                                  <td class="d-none">{{$d->id}}</td>
                                  <td style="vertical-align: top"><a href="mailto:{{$d->email}}">{{$d->email}}</a></td>
                                  <td style="vertical-align: top">
                                    <a class="delete-button del-icon" id='del_<?= $d->id ?>' data-id='<?= $d->id ?>' style="cursor: pointer;"><i class="far fa-trash-alt"></i></a>
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
                <!-- Client Section End -->
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>
</div>


<script>
  $(document).on('click', '.delete-button', function() {
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
          url: '{{ url("newsletters") }}/' + $(this).data('id'),
          type: 'delete',
          data: {
            "_token": "{{ csrf_token() }}",
          },
          success: function(response) {
            $(el).closest('tr').css('background', 'tomato');
            $(el).closest('tr').fadeOut(800, function() {
              $(this).remove();
            });
          }
        });
      }
    })
  });
</script>

@endsection