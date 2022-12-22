@extends('layouts.landing')

@section('title', 'Home')

@section('content')
    <div class="h-full flex flex-col justify-center items-center">
        <div class="flex justify-between items-center my-5 mx-3">
            <h1 class="text-4xl">Project planning simplified</h1>

        </div>
        <div>
            <a class="text-black bg-main-light border-0 py-2 px-6 focus:outline-none hover:bg-main-red hover:text-white rounded text-lg transition-colors" href="">Learn more</a>
            <a class="text-white bg-main-blue border-0 py-2 px-6 focus:outline-none hover:bg-secondary-blue rounded text-lg transition-colors" href="{{ route('register') }}">Sign up now</a>
        </div>
    </div>
@endsection
