@extends('layouts.app')
@section('title', 'Absence Calculator')
@section('content')

<div class ="container">

  <button type="button" class="btn btn-link"></button>

  <div class="card uper">
    <div class="card-header">
      Absence Calculator
    </div>

    <div class="card-body">
      <form method="post" action="{{ route('absence.search') }}">
        @csrf
        <div class="form-group">
          <label for="name">Block Name</label>
          <select class="form-control" name="block_id" required/>
          <option value="">Select a Block</option>
          @foreach ($blocks as $block)
          <option value="{{$block->id}}">{{$block->block_title}}</option>
          @endforeach
        </select>
        </div>

        <div class="form-group">
          <label for="name">Batch</label>
          <select class="form-control" name="batch_number" required/>
          <option value="">Select a Batch</option>
          @foreach ($batches as $batch)
          <option value="{{$batch->batch}}">{{$batch->batch}}</option>
          @endforeach
        </select>
        </div>

        <div class="form-group">
          <label for="name">Total Number of Sessions</label>
          <input type="number" class="form-control" name="sessions_count" required/>
        </div>

        <button type="submit" class="btn btn-primary">Today Absence</button>
      </form>
    </div>

  </div>
</div>
@endsection
