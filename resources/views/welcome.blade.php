@extends('layouts.app')

@section('content')

<div class="container">
    
    <div id="welcome">
    <h3>The app to guide teachers, children and parents on the reading learning journey</h3>
    <p>Click below to login or register for an account to get started</p>
    </div> 

    <div id="parent">
        <button id="parentButt"><a href="{{ url('/login') }}">I'm a Parent</a></button>
    </div> 

    <div id="teacher">
        <button id="teacherButt"><a href="{{ url('/teacher/login') }}">I'm a Teacher</a></button>
    </div> 
    
</div>
@endsection

