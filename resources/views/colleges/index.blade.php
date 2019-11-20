@extends('layouts.app')
@section('title', 'College')
@section('content')

<div class = 'container'>
  <div class="row">
<div class="col">
<a class="btn btn-primary" href="{{ route('college.create')}}" role="button">New +</a>
</div>
</div>
<button type="button" class="btn btn-link"></button>
<div class="card uper">
  <div class="card-header">
   Colleges
  </div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>College Name</td>
          <td>Description</td>
        </tr>
    </thead>
    <tbody>
    
        @foreach($colleges as $college)
        <tr>
            <td>{{$college->name}}</td>
            <td>{{$college->description}}</td>
            <td>   
            <td><a href="{{ route('college.edit',$college->id)}}" class="btn btn-primary">Edit</a></td>
            <td><form onsubmit="return confirm('Do you really want to delete?');" action="{{ route('college.destroy', $college->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form></td>
        
        </tr>
        @endforeach
    </tbody>
  </table>
</div></div>
@endsection
