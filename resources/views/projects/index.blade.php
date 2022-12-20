@extends('layouts.default')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    @extends('components.structure.navbar')

    <h1 class="text-4xl mb-4">Birdboard</h1>

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
