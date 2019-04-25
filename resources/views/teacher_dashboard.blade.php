@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>

        <style> 

            .panel-heading{
                font-size: 20px;
                background-color: #80D4FF;  /*blue*/
            }

            .className, .year{
                float: right;
                display: inline;
                font-size: 20px;
                text-align: right;
                padding-bottom:15px;
            }
            .year{
                padding-right: 20px;
            }
        
            /*CSS for table*/
            table {
                border-collapse: collapse;
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
                text-align: center;
                padding:15px;
            }
            th{
              width:20%;
              height:50px;
              text-weight:bold;  
            }

        </style>
</head>
<body>

<?php

$pupils = DB::table('pupils')
        ->join('users', 'pupils.id', '=', 'users.id')
        ->join('teachers', 'pupils.className', '=', 'teachers.className')
        ->select('pupils.pupilID as pupilid', 'pupils.name as pupilname', 'pupils.readingLevel as level', 'users.name as parentname', 'users.email as email', 'pupils.className as class')
        ->get();

$year = DB::table('teacher_pupils')
        ->join('pupils', 'pupils.pupilID', '=', 'teacher_pupils.pupilID')
        ->join('teachers', 'teachers.teacherID', '=', 'teacher_pupils.teacherID')
        ->select('teacher_pupils.academicYear as year')
        ->get(); 

?>

<div class="container">
    <div class="row">
@foreach($pupils as $p)
@if($loop->first)    
    <div class="className">Class: {{ $p->class }} </div>
@endif                
@endforeach

@foreach($year as $y)
@if($loop->first)
    <div class="year">Academic Year: {{ $y->year }} </div>  
@endif                
@endforeach 

<button id="classReportButt">
    <a href="{{ route('teacher.report') }}">My Class' Progress</a>
</button>    

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Teacher Dashboard</div>

                <div class="panel-body">
                <table id="classOfPupils">
                    <tr>
                        <th>Pupil</th>
                        <th>Current Reading Level</th>    
                        <th>Parent</th>
                        <th>Parent's Email Address</th>
                        <th></th>                
                    </tr>
                    @foreach($pupils as $r)
                    <tr>
                        <td>{{ $r->pupilname }}</td>
                        <td>{{ $r->level }}</td>
                        <td>{{ $r->parentname }}</td>
                        <td>{{ $r->email }}</td>
                        <td>
                            <button class="btn"> <a href="{{ route('readingrecord', ['id' => $r->pupilid]) }}"> View Details </button>  
                        </td>
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