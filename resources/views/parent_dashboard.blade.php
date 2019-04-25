@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Parent Dashboard</title>
</head>
<body>   

<?php

//Get the currently authenticated user's ID 
$id = Auth::id();
//for testing
//echo $id;  

$children = DB::table('pupils')
        ->join('users', 'pupils.id', '=', 'users.id')
        ->select('pupils.pupilID as pupilid', 'pupils.name as pupilname')
        ->where('users.id', '=', $id)
        ->get();
?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Parent Dashboard</div>

                <div class="panel-body">
                    Select child to view their reading record.
                    
                    @foreach($children as $c)
                    <table>
                        <td>
                            <button class="btn"> <a href="{{ route('childrecord', ['id' => $c->pupilid]) }}"> {{$c->pupilname}} </button>    
                        </td>
                    </table>
                    @endforeach
                </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>