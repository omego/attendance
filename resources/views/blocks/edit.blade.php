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
        <div class="form-group">
          <label for="name">Block Title</label>
          <input type="text" class="form-control" name="block_title" value="{{ $block->block_title }}" required/>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
</div>
@endsection
