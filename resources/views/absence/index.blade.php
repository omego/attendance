@extends('layouts.app')
@section('title', 'Absence Sheet')
@section('content')

<div class ="container">

  <button type="button" class="btn btn-link"></button>

  <div class="card uper">
    <div class="card-header">
      Absence Sheet
    </div>
    <div class="card-body">
    <div class="row">
      <div class="col-md-12">
      <h3><span class="badge badge-secondary"> Block Title: {{$block->block_title}}</span>
      <span class="badge badge-secondary"> Batch Number: {{$batch_number}}</span>
      <span class="badge badge-secondary"> Total Sessions: {{$sessions_count}}</span>
      <span class="badge badge-secondary"> Date: {{$date}}</span>
    </h3>
      </div>
    </div>
  </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <td></td>
          <td>Name</td>
          <td>Sessions</td>
          <td>Number</td>
          <td>Badge</td>
        </tr>
      </thead>
      <tbody>

        @foreach($absentList as $key => $absent)
        <tr>
          @if ($absent['sessions'])
          <td data-toggle="collapse" data-target="#demo{{$absent->id}}" class="text-primary"><i class="fas fa-eye"></i></td>
          @else
          <td></td>
          @endif
          <td>{{$absent->name}}</td>
          <td>{{$absent->count}}/{{$sessions_count}}</td>
          <td>{{$absent->student_number}}</td>
          <td>{{$absent->badge_number}}</td>
        </tr>
        @if ($absent['sessions'])
        <tr class="hiddenRow">
          <td colspan="6" id="demo{{$absent->id}}" class="collapse">
              @foreach($absent['sessions'] as $key1 => $session)
              <span class="badge badge-primary">{{$session['time']}}</span>
              @endforeach
          </td>
        </tr>
        @endif
        @endforeach

      </table>
    </div>
  </div>
  @endsection
