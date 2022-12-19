@extends('layouts.default')

@section('title')
    {{ $project->title }}
@endsection

@section('content')
    <h1>{{ $project->title }}</h1>

    <p>
        {{ $project->description }}
    </p>
@endsection
