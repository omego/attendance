@extends('layouts.app')
@section('title', 'Problems')
@section('content')

<div class = 'container'>
  <div class="row">
{{-- <div class="col">
<a class="btn btn-primary" href="{{ route('problem.create')}}" role="button">New +</a>
</div> --}}
</div>
<button type="button" class="btn btn-link"></button>
<div class="card uper">
  <div class="card-header">
   All Problems
  </div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          {{-- <td>ID</td> --}}
          <td>User Name</td>
          <td>Problem Title</td>
          <td>Problem Content</td>
          <td>Date/Time</td>
          <td>GPS</td>
          <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($problems as $problem)
        @if(!empty($problem->user->name))
        <tr>
            {{-- <td>{{$problem->id}}</td> --}}
            <td>{{$problem->user->name}}</td>
            <td>{{$problem->problem_title}}</td>
            <td>{{$problem->problem_content}}</td>
            <td>{{$problem->created_at}} <b>({{$problem['created_at']->diffForHumans()}})</b></td>
            {{-- <td><a href="{{ route('category.edit',$category->id)}}" class="btn btn-primary">Edit</a></td> --}}
            <td>
                <form onsubmit="return confirm('Do you really want to delete?');" action="{{ route('problem.destroy', $problem->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
                <div class="text-right">
                    <ul> {{ $problems->links() }} </ul>
                </div>
            </td>
        </tr>
    </tfoot>
  </table>
</div></div>
@endsection
