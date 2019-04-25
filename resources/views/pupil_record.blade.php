@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Pupil Details</title>

    <style>
        .className, .year{
            float: right;
            display: inline;
            text-align: right;
            font-size: 20px;
            padding-bottom: 15px;
        }

        .className{
            padding-right: 20px;
        }

        /*CSS for table*/
        table{
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        th{
            text-weight:bold;
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script scr="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body> 

<div class="container">
    <div class="row">
  
<?php 
    $year = DB::table('teacher_pupils')
        ->join('pupils', 'pupils.pupilID', '=', 'teacher_pupils.pupilID')
        ->join('teachers', 'teachers.teacherID', '=', 'teacher_pupils.teacherID')
        ->select('teacher_pupils.academicYear as year')
        ->get(); 
?>        

@foreach($year as $y)
@if($loop->first)
    <div class="year">Academic Year: {{ $y->year }} </div>  
@endif                
@endforeach 

@foreach($pupils as $p)
@if($loop->first)    
    <div class="className">Class: {{ $p->class }} </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ $p->name }}'s Reading Record</div>
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

<div class="container">
    <div class="row">  
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
@foreach($pupils as $p)
@if($loop->first)            
                <div class="panel-heading"> Assign Book to {{ $p->name }} </div>
@endif                
@endforeach 
                <div class="panel-body">               
                
                <form class="form-horizontal" role="form" method="POST" action="{{ route('teacher.assignment.submit') }}">             
                    {{ csrf_field() }}

                    <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Book Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Search Book Name">
                        </div>
                        <div id="bookList"></div>
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
                        <select name="band" class="form-control" value="{{ old('band') }}">
                            <option value="lilac" id="1"></option>
                            <option value="pink" id="2">Pink</option>
                            <option value="red" id="3">Red</option>
                            <option value="yellow" id="4">Yellow</option>
                            <option value="blue" id="5">Blue</option>
                            <option value="green" id="6">Green</option>
                            <option value="orange" id="7">Orange</option>
                            <option value="turquoise" id="8">Turquoise</option>
                            <option value="purple" id="9">Purple</option>
                            <option value="gold" id="10">Gold</option>
                            <option value="white" id="11">White</option>
                            <option value="lime" id="12">Lime</option>
                        </select>
                        </div>
                    </div>
                        
                    <div class="form-group">
                    <label for="due" class="col-md-4 control-label">Due Date</label>
                        <div class="col-md-6">
                            <input id="due" type="date" class="form-control" name="due" value="{{ old('due') }}">
                        </div>    
                    </div>    
                        
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Assign
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
        @foreach($pupils as $p)
            @if($loop->first)
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Add Guided Reading Session with {{ $p->name }}</div>
            @endif
        @endforeach
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('teacher.guided.submit') }}">
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

@endsection

<script>
$(document).ready(function(){

    $('#name').keyup(function(){
        var query = $(this).val();
        if(query != ''){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('livesearch.fetch') }}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                    $('#bookList').fadeIn();
                    $('#bookList').html(data);
                }
            })
        }
    });

});

</script>

</body>