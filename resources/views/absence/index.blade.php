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
          <td>Block</td>
          <td>Number</td>
          <td>Badge</td>
          <td>Batch</td>
        </tr>
      </thead>
      <tbody>

        @foreach($absentList as $absent)
        <tr>
          <td>{{$absent->name}}</td>
          <td>{{$block->block_title}}</td>
          <td>{{$absent->student_number}}</td>
          <td>{{$absent->badge_number}}</td>
          <td>{{$absent->batch}}</td>
        </tr>
        @endforeach

        <tfoot>
          <tr>
            <td colspan="6">
              <div class="text-left">
                <ul> {{ $absentList->links() }} </ul>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <div class="text-left">
                Total Number of Students Who Were Partially Absent: <b>{{$partiallyAbsentCount}}<b>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>

    </div>
  </div>
@endsection
