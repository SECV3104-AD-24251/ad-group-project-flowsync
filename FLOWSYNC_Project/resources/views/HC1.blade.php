@extends('layouts.student')  

@section('content')
<section class="text-gray-600 body-font">
  <div class="container px-5 py-12 mx-auto">
    <div class="flex items-center mb-8">
        <a href="{{ route('helpCenter.index') }}" class="flex items-center text-gray-500 hover:text-gray-800 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>
    <div class="bg-white max-w-8xl mx-auto p-6 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $helpContent->title }}</h1>
      <p class="text-gray-700 mb-4">{{ $helpContent->description }}</p>
      <ol class="list-decimal list-inside text-gray-700 space-y-2">
        @foreach (explode("\n", $helpContent->steps) as $step)
          <li>{!! $step !!}</li>
        @endforeach
      </ol>
    </div>
  </div>
</section>
@endsection
