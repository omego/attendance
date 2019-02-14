@extends('layouts.app')
@section('title', 'Create Problem')
@section('content')

<div class = 'container'>
<div class="card uper">
  <div class="card-header">
    Add new Problem
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('problem.store') }}">
          <div class="form-group">
              @csrf

              <select class="custom-select custom-select-lg mb-3" name="problem_title" required>
                <option value="" selected>*What is the problem?</option>
                <option value="Location Not Working or Incorrect">Location Not Working or Incorrect</option>
                <option value="Location Not Working or Incorrect">My information Incorrect</option>
                <option value="The Attendance button is not visible">The Attendance Button is Not Visible</option>
                <option value="The Lecturer is Absent">The Lecturer is Absent</option>
                <option value="Some Students Escaped The Session After They Were Here!">Some Students Escaped The Session After They Were Here!</option>
                <option value="Other">Other (Write Below)</option>
              </select>
          </div>

          <div class="form-group">
          <label for="ProblemDescription">Problem Description (optional)</label>
          <textarea class="form-control" name="problem_content" id="ProblemDescription" rows="3"></textarea>
          <div id="coords"></div>
        </div>

          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div></div>
@push('geolocation')
<script type="text/javascript" src="{{ secure_url('js/geolocation.js') }}"></script>
@endpush
@endsection
