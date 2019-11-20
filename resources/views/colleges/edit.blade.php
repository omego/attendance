@extends('layouts.app')
@section('title', 'Edit: ' . $college->name)
@section('content')

<div class = 'container'>
  <div class="card uper">
    <div class="card-header">
      Edit College
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
      <form method="post" action="{{ route('college.update', $college->id) }}">
        @method('PATCH')
        @csrf

        <input type="hidden" id="block_id" value="{{$college->id}}">
        <div class="form-group">
          <label for="name">College Name</label>
          <input type="text" class="form-control" name="name" value="{{ $college->name }}" required/>
        </div>

        <div class="form-group">
          <label for="name">College Desctiption</label>
          <input type="text" class="form-control" name="description" value="{{ $college->description }}" required/>
        </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
</div>
@endsection
