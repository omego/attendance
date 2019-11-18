@extends('layouts.app')
@section('title', 'Absence Sheet')
@section('content')

<div class ="container">

  <button type="button" class="btn btn-link"></button>

  <div class="card uper">
    <div class="card-header">
      Today Absence of Block: <b>{{$block->block_title}}</b>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <td>Name</td>
          <td>Sessions</td>
          <td>Number</td>
          <td>Badge</td>
          <td>Batch</td>
        </tr>
      </thead>
      <tbody>

        @foreach($absentList as $absent)
        <tr>
          <td>{{$absent->name}}</td>
          <td>{{$absent->sessions}}/{{$sessions_count}}</td>
          <td>{{$absent->student_number}}</td>
          <td>{{$absent->badge_number}}</td>
          <td>{{$absent->batch}}</td>
        </tr>
        @endforeach

  </table>
  <div class="text-right">
    <button type="submit" class="btn btn-primary">Export</button>
  </div>

</div>
</div>
@endsection
