@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Child Details</title>

    <style>
        .className{
            text-align: right;
            font-size: 20px;
            padding-bottom: 15px;
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
            
            text-weight:bold;  
        }

        i:hover{
            cursor: help;
        }

    </style>
</head>



<body> 
<div class="container">
    <div class="row">
  
@foreach($children as $c)
@if($loop->first)    
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ $c->name }}'s Reading Record 
                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                Current Reading Level: {{ $c->level }}  
                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp                   
                Class: {{ $c->class }}
                </div>
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
                    @foreach($children as $r)
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
                <div class="panel-heading"> Add Comments </div>
                <div class="panel-body"> 

                <p>When reading assigned books with your child, please write out some notes on their reading experience each time you read together. Be sure to note how many pages of the book was read in each session. Then, click Submit to add your comments to your child's record.</p>              
                
                <form class="form-horizontal" role="form" method="POST" action="{{ route('parent.comment.submit') }}">             
                {{ csrf_field() }}

                    <div class="form-group">
                    <label for="bookname" class="col-md-4 control-label">Book Name</label>
                        <div class="col-md-6">
                        <select name="bookname" class="form-control" value="{{ old('bookname') }}">
                            @foreach($children as $c)     
                            <option value="{{ $c->rid }}"> {{ $c->title }} </option>      
                            @endforeach
                        </select>
                        </div>
                    </div> 

                    <div class="form-group">

                    <label for="comment" class="col-md-4 control-label">Comments 
                    <i class="fa fa-info-circle" title="Suggestions for things to include in your comments: Was the book too easy/difficult? Any words they struggled with? Their level of enjoyment of the story. Comments about reading pace, intonation, expression and punctuation." aria-hidden="true"></i>
                    </label>
                        <div class="col-md-6">
                            <textarea rows="4" cols="50" id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}"></textarea>
                        </div>
                    </div>  
                        
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
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

</body>