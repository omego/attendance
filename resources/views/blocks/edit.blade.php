@extends('layouts.app')
@section('title', 'Edit: ' . $block->block_title)
@section('content')

<div class = 'container'>
  <div class="card uper">
    <div class="card-header">
      Edit Block
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
      <form method="post" action="{{ route('blocks.update', $block->id) }}">
        @method('PATCH')
        @csrf

        <input type="hidden" id="block_id" value="{{$block->id}}">
        <div class="form-group">
          <label for="name">Block Title</label>
          <input type="text" class="form-control" name="block_title" value="{{ $block->block_title }}" required/>
        </div>

      <div class="form-group">
          <label for="name">Batch Number</label>
          <select class="form-control" name="batchList" id="batchList" required/>
          <option value="">Select a batch</option>
          @foreach ($batches as $batch)
          <option value="{{$batch->batch}}">{{$batch->batch}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span>
        <label for="name">Batch Students</label>
      </div>

      <div class="form-group">
        <label for="name">Select All</label> &nbsp;
        <input type="checkbox" id="selectAll">
        <div id="assignStuToBlock"></div>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
</div>
@endsection
