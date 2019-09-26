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
                                    <div id="error" class="alert alert-danger">

                                    </div>
                                    <div id="success" class="alert alert-success">

                                        </div>

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
                </div>
            </div>
        </div>
    </div>
</div>



      <!-- Modal -->
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
