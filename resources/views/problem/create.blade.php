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
                <option value="Location Not Working">Location Not Working</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
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
