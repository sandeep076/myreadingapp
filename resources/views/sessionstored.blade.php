@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <title>Confirmation</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Guided reading session details saved!</div>
                <a class="btn btn-link" href="{{ url('/teacher') }}">Back to homepage</a>
            </div>
        </div>
    </body>
</html>
@endsection