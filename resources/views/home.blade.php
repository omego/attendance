@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="tripmeter">
                            <p>
                              Starting Location (lat, lon):<br/>
                              <span id="startLat">???</span>&deg;, <span id="startLon">???</span>&deg;
                            </p>
                            <p>
                              Current Location (lat, lon):<br/>
                              <span id="currentLat">locating...</span>&deg;, <span id="currentLon">locating...</span>&deg;
                            </p>
                            <p>
                              Distance from starting location:<br/>
                              <span id="distance">0</span> km
                            </p>
                             <p>
                              Are we here?<br/>
                              <span id="message">detecting....</span>
                              <button type="submit" class="btn btn-primary">
                                    {{ __('Attend') }}
                                </button>
                            </p>
                          </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
