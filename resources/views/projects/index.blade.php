@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <section class="flex flex-wrap">
        @forelse ($projects as $project)
            <a href="{{ route('projects.show', $project->id) }}" class="md:w-1/3 hover:scale-105 transition-all">
                @if(Auth::user()->role != 1)
                <div class="bg-white rounded shadow mr-3 p-5 my-3 flex flex-col justify-between" style="height: 200px">
                    <div class="h-1/2">
                        <h3 class="text-xl">
                            {{ $project->title }}
                        </h3>
                    </div>
                    <div class="h-1/2">
                        <p class="text-gray-500">
                            {{ Str::limit($project->description) }}
                        </p>
                    </div>
                </div>
                @else
                    <div class="bg-white rounded shadow mr-3 p-5 my-3 flex flex-col justify-between" style="height: 200px">
                        <div class="h-1/3">
                            <h3 class="text-xl">
                                {{ $project->title }}
                            </h3>
                        </div>
                        <div class="h-2/3 flex flex-col justify-between">
                            <p class="text-gray-500">
                                {{ Str::limit($project->description) }}
                            </p>
                        <span class="bold text-blue-800 py-2.5">
                            {{ $project->owner->name }}
                        </span>
                        </div>
                    </div>
                @endif
            </a>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </section>

@endsection
