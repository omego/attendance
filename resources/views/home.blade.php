@extends('layouts.app')

@section('content')
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
                <div class="card-header">Dashboard</div>

                <div class="card-body">


                    <div id="tripmeter">
                            <p>
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
                                <span id="currentAcc">0</span> %
                            </p>
                             <p>
                              Are we here?<br/>
                              <span id="message">detecting....</span>
                             
                            </p>
                            <p>
                                 <!-- Button trigger modal -->
                                    <button id="attendBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Attend a Session
                                        </button>
                            </p>
                          </div>
                          <p>Your attendance today:</p>
                          <table class="table table-striped">
                                <thead>
                                    <tr>
                                      <td>ID</td>
                                      <td>user id</td>
                                      <td>block id</td>
                                      <td>when?</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($UserAttendance as $Attendance)
                                    <tr>
                                        <td>{{$Attendance['id']}}</td>
                                        <td>{{$Attendance['user_id']}}</td>
                                        <td>{{$Attendance['block_id']}}</td>
                                        <td>{{$Attendance['created_at']}}</td>
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
                            <select class="form-control" name="block_id" id="exampleFormControlSelect1">
                              @foreach ($blocks as $block)
                                <option value="{{$block->id}}">{{$block->block_title}}</option>
                              @endforeach
                            </select>
                            <input type="text" class="form-control" name="user_id" value="{{$user->id}}" hidden />
                          </div>
            </div>
            <div class="modal-footer">
              <button type="submit" onclick="this.disabled=true;this.form.submit();" class="btn btn-primary">Record Attendance</button>
            </div>
          </div>
        </form>
        </div>
      </div>
        @push('geolocation')
        <script type="text/javascript" src="{{ secure_url('js/geolocation.js') }}"></script>
        @endpush
@endsection
