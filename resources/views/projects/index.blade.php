@extends('layouts.default')

@section('title')
    Projects
@endsection

@section('content')
    <h1>Birdboard</h1>

    <ul>
        @forelse ($projects as $project)
            <li>
                <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
            </li>
        @empty
            <li>No projects yet.</li>
        @endforelse
    </ul>
@endsection
