@extends('layouts.app')

@section('content')
        <!DOCTYPE html>
<html>
<head>
    <title>Guided Reading Session</title>
</head>

<body>

<?php

use App\Http\Requests;
use Illuminate\Http\Request;

$pupils = DB::table('pupils')
    ->join('users', 'pupils.id', '=', 'users.id')
    ->select('pupils.pupilID as pupilid', 'pupils.name as pupilname', 'pupils.readingLevel as level', 'users.name as parentname', 'users.email as email', 'pupils.className as class')
    ->where('pupils.pupilID', '=', $request->session()->get('pid'))
    ->get();
?>

<div class="container">
    <div class="row">

        <button class="btn"> <a href="{{ route('teacher.dashboard') }}"> Back to My Class </button>

        @foreach($pupils as $p)
            @if($loop->first)
                <div class="className">Class: {{ $p->class }} </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Add Guided Reading Session with {{ $p->name }}</div>
                        @endif
                        @endforeach
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('teacher.assignment.submit') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="currlevel" class="col-md-4 control-label">Pupil's Current Reading Level</label>
                                    <div class="col-md-6">
                                        @foreach($pupils as $p)
                                            @if($loop->first)
                                                <input id="currlevel" type="text" class="form-control" name="currlevel" value="{{ $p->level }}" readonly>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bookname" class="col-md-4 control-label">Book Name</label>
                                    <div class="col-md-6">
                                        <input id="bookname" type="text" class="form-control" name="bookname" value="{{ old('bookname') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="author" class="col-md-4 control-label">Author</label>
                                    <div class="col-md-6">
                                        <input id="author" type="text" class="form-control" name="author" value="{{ old('author') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="band" class="col-md-4 control-label">Book Band</label>
                                    <div class="col-md-6">
                                        <input id="band" type="text" class="form-control" name="band" value="{{ old('band') }}">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="notes" class="col-md-4 control-label">Notes about this session
                                    </label>
                                    <div class="col-md-6">
                                        <textarea rows="4" cols="50" id="notes" type="text" class="form-control" name="notes" value="{{ old('notes') }}"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="newlevel" class="col-md-4 control-label">Change Reading Level (if appropriate)</label>
                                    <div class="col-md-6">
                                        <select name="newlevel" class="form-control" value="{{ old('newlevel') }}">
                                            <option value="no_change">No Change</option>
                                            <option value="lilac">Lilac</option>
                                            <option value="pink">Pink</option>
                                            <option value="red">Red</option>
                                            <option value="yellow">Yellow</option>
                                            <option value="blue">Blue</option>
                                            <option value="green">Green</option>
                                            <option value="orange">Orange</option>
                                            <option value="turquoise">Turquoise</option>
                                            <option value="purple">Purple</option>
                                            <option value="gold">Gold</option>
                                            <option value="white">White</option>
                                            <option value="lime">Lime</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Add Guided Reading Session
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @foreach($pupils as $p)
                    @if($loop->first)
                        <div class="panel-heading"> {{ $p->name }}'s Recent Reading Records </div>
                    @endif
                @endforeach

                <div class="panel-body">

                    <table id="readingRecord">
                        <tr>
                            <th>Book Name</th>
                            <th>Book Band</th>
                            <th>Author</th>
                            <th>Assigned By</th>
                            <th>Date Assigned</th>
                            <th>Due Date</th>
                            <th>Parent's Comments</th>
                        </tr>
                        @foreach($pupils as $r)
                            <tr>
                                <td>{{ $r->title }}</td>
                                <td>{{ $r->level }}</td>
                                <td>{{ $r->author }}</td>
                                <td>{{ $r->assignedBy }}</td>
                                <td>{{ $r->dateAssigned }}</td>
                                <td>{{ $r->dueDate }}</td>
                                <td>{{ $r->parentComments }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>


            </div>
        </div>
    </div>
</div>

@endsection

</body>