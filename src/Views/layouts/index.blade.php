@extends('layouts.master')

@section('content')
    <h1>Hello World from logtailer package </h1>

    <p>
        This view is loaded from module: {!! Config('config.name') !!}
    </p>
@stop
