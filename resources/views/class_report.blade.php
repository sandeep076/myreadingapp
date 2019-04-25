@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>My Class' Progress Report</title>

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

$loggedInId = Auth::teacher()->id;
\Log::info('Teacher id is ' . $loggedInId);

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
foreach($pupils as $p){
    $count = DB::table('reading_records')
            ->join('teachers', 'teachers.teacherID', '=', 'reading_records.teacherID')
            ->where('teachers.teacherID', '=', '$loggedInId')
            ->where('reading_records.pupilID', '=', '$p')
            ->count();
    $startdate = "2018-09-07";
    $today = date("Y-m-d");        
    $daysDiff = date_diff($startdate,$today);
    $weeksDiff = $daysDiff/7;
    $overallAvg = $count/$weeksDiff;
}

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

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">My Class' Progress Report</div>

                <div class="panel-body">
                    <p>Reading Consistency</p>
                <table id="classOfPupils">
                    <tr>
                        <th>Pupil Name</th>
                        <th>Overall Average Number of Home Reading Sessions per week</th>    
                        <th>Past Month's Average Number of Home Reading Sessions per week</th>
                        <th>Current Reading Level</th>
                        <th>Parent Name</th>                
                    </tr>
                    @foreach($pupils as $r)
                    <tr>
                        <td>{{ $r->pupilname }}</td>
                        <td>{{ $r->level }}</td>
                        <td>{{ $r->parentname }}</td>
                        <td></td>
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