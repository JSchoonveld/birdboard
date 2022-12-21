@extends('layouts.app')

@section('title')
    {{ $project->title }}
@endsection

@section('content')
    <h1 class="text-4xl mb-4">{{ $project->title }}</h1>

    <p>
        {{ $project->description }}
    </p>

    <a class="text-blue-900 hover:text-blue-500 underline transition-colors" href="{{ route('projects.index') }}">Back</a>
@endsection
