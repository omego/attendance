@extends('layouts.app')
@section('title', 'Attend')
@section('content')
<script>
  var GOOGLE_API = '{!! env("GOOGLE_MAPS_STATIC_API") !!}';
  </script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if(session()->get('success'))
                <div class="alert alert-success">
                  {{ session()->get('success') }}
                </div><br />
              @endif
              @if(session()->get('danger'))
                <div class="alert alert-danger">
                  {{ session()->get('danger') }}
                </div><br />
              @endif
            <div class="card">
                <div class="card-header">{{$user->name}} - Number: {{$user->student_number}} - Badge: {{$user->badge_number}}
                  <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger btn-sm float-right" data-toggle="modal" data-target="#problem">
                  Problem?
                </button>
                </div>

                      <!-- Modal -->
      <div class="modal fade" id="problem" tabindex="-1" role="dialog" aria-labelledby="problemTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="problem">Submit Your Problem</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <form method="post" action="{{ route('problem.store') }}">
                      <div class="form-group">
                          @csrf

                          <select class="custom-select custom-select-lg mb-3" name="problem_title" required>
                            <option value="" selected>*What is the problem?</option>
                            <option value="🗺 Location Not Working or Incorrect">🗺 Location Not Working</option>
                            <option value="❌ My information Incorrect">❌ My information Incorrect</option>
                            <option value="🔍 The Attendance button is not visible">🔍 Attendance Button Not Visible</option>
                            <option value="👨🏻‍⚕️ The Lecturer is Absent">👨🏻‍⚕️ Absent Lecturer</option>
                            {{-- <option value="🚷 Students Escaped">🚷 Students Escaped</option> --}}
                            <option value="Other">Other (Write Below)</option>
                          </select>
                      </div>

                      <div class="form-group">
                      <label for="ProblemDescription">Problem Description (optional)</label>
                      <textarea class="form-control" name="problem_content" id="ProblemDescription" rows="3"></textarea>
                    </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-lg btn-block">Send 🚀</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

                <div class="card-body">


                    <div id="tripmeter">
                            {{-- <p>
                              Starting Location (lat, lon):<br/>
                              <span id="startLat">???</span>&deg;, <span id="startLon">???</span>&deg;
                            </p>
                            <p>
                              Current Location (lat, lon):<br/>
                              <span id="currentLat">locating...</span>&deg;, <span id="currentLon">locating...</span>&deg;
                            </p>
                            <p>
                              Distance from starting location:<br/>
                              <span id="distance">0</span> km
                            </p>
                            <p>
                                Location accuracy:<br/>
                                <span id="currentAcc">0</span> M
                            </p> --}}
                             <p>
                              Are we here?<br/>
                              <span id="message"><i id="spinner" class="fa fa-spinner fa-pulse"></i></span>

                            </p>
                            <p>
 <!-- Tutorial -->

                                  <div class="alert alert-danger">
                                    <div id="error"></div>
                                    <div id="tutorial">                   
                                      <button type="button" class="btn btn-link" data-toggle="modal" data-target="#tutorialModal">
                                            To Enable location check here
                                      </button>
                                      
                                      <div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorial" data-dismiss="modal" aria-label="Close" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                          <div class="modal-content">
                                          
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tutorialModal">Enable Geolocation</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                            
                                            <div class="modal-body">
                                                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                  <li class="nav-item active">
                                                    <a class="nav-link in active" id="iphone-tab" data-toggle="tab" href="#iphone" role="tab" aria-controls="home" aria-selected="true">iPhone</a>
                                                  </li>
                                                  <li class="nav-item">
                                                    <a class="nav-link" id="androied-tab" data-toggle="tab" href="#android" role="tab" aria-controls="profile" aria-selected="false">Android</a>
                                                  </li>
                                                </ul> 
                                          
                                                <div class="tab-content">
                                                    <div id="iphone" class="tab-pane fade show active">
                                                      <br>
                                                      <b style="font-size:15px" >To Enable Location Services Please Follow the Instructions:</b>
                                                      <p style="font-size:15px" >Settings > privacy > location Services > Safari > While Using the App</p>
                                                      <img src="/images/iphone1.png" style="width:165.9px;height:317.8px;">
                                                      <img src="/images/iphone2.png" style="width:165.9px;height:317.8px;">
                                                    </div>
                                                    <div id="android" class="tab-pane fade">
                                                    <br>
                                                      <b style="font-size:15px" >To Enable Location Services Please Follow the Instructions:</b>
                                                      <p style="font-size:15px" >Settings > site Settings > Location > On</p>
                                                      <img src="/images/android1.png"style="width:165.9px;height:317.8px;">
                                                      <img src="/images/android2.png"style="width:165.9px;height:317.8px;">
                                                      <img src="/images/android3.png"style="width:165.9px;height:317.8px;">
                                                    </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                   </div>
 <!-- /Tutorial -->
                                    </div>
                                  </div>
                                   
                                    <div id="success" class="alert alert-success"></div>

                            </p>
                            <p>
                                    <button id="attendBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Attend a Session
                                        </button>
                            </p>
                            <p>
                                    <div id="mapholder"></div>
                            </p>
                          </div>
                          <p>Your attendance today:</p>
                          <table class="table table-striped">
                                <thead>
                                    <tr>
                                      <td>Number</td>
                                      <td>block id</td>
                                      <td>when?</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($UserAttendance as $Attendance)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        @if (isset($Attendance->block->block_title))
                                        <td><b>{{$Attendance->block->block_title}}</b></td>
                                        @endif
                                        <td>{{$Attendance['created_at']}} ({{$Attendance['created_at']->diffForHumans()}})</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                                    <!-- -- Modal --> 
     
                </div>
            </div>
        </div>
    </div>
</div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
                <form method="post" action="{{ route('attendancesheets.store') }}">
                    @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Select your block</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                            <label for="exampleFormControlSelect1">Block</label>
                            <select class="form-control" name="block_id" required>

                              @if ($blocks->isNotEmpty())

                              @foreach ($blocks as $block)
                                <option value="{{$block->id}}">{{$block->block_title}}</option>
                              @endforeach

                            @else
                              <option selected value> -- You are not assigned to any blocks -- </option>
                              @endif
                            </select>
                            <input type="text" class="form-control" name="user_id" value="{{$user->id}}" hidden />
                            <div id="coords"></div>
                          </div>
            </div>
            <div class="modal-footer">
              <button type="submit" onclick="newModalForm();this.disabled=true;this.form.submit();" class="btn btn-primary">Record Attendance</button>
            </div>
          </div>
        </form>
        </div>
      </div>


        @push('geolocation')
        <script type="text/javascript" src="{{ secure_url('js/geolocation.js') }}"></script>
        @endpush
@endsection
