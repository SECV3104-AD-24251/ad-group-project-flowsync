@extends('layouts.app')

@section('content')
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex w-full mb-10 flex-wrap">
      <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 ">TIMETABLE MANAGEMENT  |  Help Center</h1>
    </div>
    
    <!-- Help Center List -->
    <div class="w-full max-w-8xl mx-auto bg-white rounded-lg shadow-md">
      <ul class="divide-y divide-gray-300">
        <!-- List Item 1 -->
        <li class="flex justify-between items-center p-4 hover:bg-gray-100 cursor-pointer">
            <!--LINK KAT HREF BAWAH NII -->
          <a href="/HC1" class="text-lg font-medium text-gray-900">How to change course section</a>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </span>
        </li>

        <!-- List Item 2 -->
        <li class="flex justify-between items-center p-4 hover:bg-gray-100 cursor-pointer">
            <!--LINK KAT HREF BAWAH NII -->
          <a href="/HC2" class="text-lg font-medium text-gray-900">How to resolve scheduling clashes</a>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </span>
        </li>

        <!-- List Item 3 -->
        <li class="flex justify-between items-center p-4 hover:bg-gray-100 cursor-pointer">
            <!--LINK KAT HREF BAWAH NII -->
          <a href="/HC3" class="text-lg font-medium text-gray-900">FAQs on Scheduling Conflicts</a>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </span>
        </li>

        <!-- List Item 4 -->
        <li class="flex justify-between items-center p-4 hover:bg-gray-100 cursor-pointer">
            <!--LINK KAT HREF BAWAH NII -->
          <a href="/HC4" class="text-lg font-medium text-gray-900">How to view timetable</a>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </span>
        </li>
      </ul>
    </div>
  </div>
</section>
@endsection
