@extends('layouts.app')
@section('title', 'Attendance Sheet')
@section('content')

<div class = 'container'>

<button type="button" class="btn btn-link"></button>

<div class="card uper">
  <div class="card-header">
   Attendance Sheet

  </div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif

  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td>Block</td>
          <td>Class</td>
          <td>Number</td>
          <td>Badge</td>
          <td>Date/Time</td>
          <td>GPS</td>
          
          {{-- <td>Groups</td> --}}

        </tr>
    </thead>
    <tbody>

  @foreach($attendancesheets as $attendancesheet)
    <tr>
      <td>{{$attendancesheet->user->name}}</td>
      <td><b>{{$attendancesheet->block->block_title}}</b></td>
      <td><b>{{$attendancesheet->beacon}}</b></td>
      <td>{{$attendancesheet->user->student_number}}</td>
      <td>{{$attendancesheet->user->badge_number}}</td>
      <td>{{$attendancesheet['created_at']}} <b>({{$attendancesheet['created_at']->diffForHumans()}})</b></td>
      <td><a href="https://maps.googleapis.com/maps/api/staticmap?center={{$attendancesheet->coords}}&zoom=16&scale=2&size=600x400&maptype=roadmap&key=AIzaSyBGCql0HlN4C_D7B2BcIIhtuFvjrdfvoew&format=png&visual_refresh=true&markers=size:small%7Ccolor:0x171faa%7Clabel:1%7C{{$attendancesheet->coords}}">Map</a></td>
    {{-- <td>

      @if(!empty($user->group))
      @foreach($user->group as $userGroup)
        {{$userGroup->group_name}} <br>
      @endforeach
        @else

          No Groups

        @endif
    </td> --}}

  </tr>
    @endforeach

  </tbody>
  <tfoot>
      <tr>
          <td colspan="6">
              <div class="text-right">
                  <ul> {{ $attendancesheets->links() }} </ul>
              </div>
          </td>
      </tr>
  </tfoot>
  </table>

</div>
{{-- {!! $users->render() !!} --}}
</div>
@endsection
