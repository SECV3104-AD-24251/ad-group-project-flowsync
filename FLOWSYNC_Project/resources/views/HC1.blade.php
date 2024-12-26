@extends('layouts.app')  

@section('content')
<section class="text-gray-600 body-font">
  <div class="container px-5 py-12 mx-auto">
    <!-- Back Button and Title -->
    <div class="flex items-center mb-8">
        <!-- Back Button to return to Help Center -->
        <a href="/helpCenter" class="flex items-center text-gray-500 hover:text-gray-800 transition duration-200">
            <!-- Back Button Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back    <!-- Back Button Text -->
        </a>
    </div>

    <!-- Title 
    <div class="flex w-full mb-10 flex-wrap">
        <h1 class="sm:text-2xl text-1xl font-medium title-font text-gray-900 ">TIMETABLE MANAGEMENT  |  Help Center</h1>
    </div>  -->

    <!-- Help Center Section -->
        <div class="mb-8">
        <div class="bg-gray-100 p-4 rounded shadow">

            <h1 class="text-xl font-semibold">TIMETABLE MANAGEMENT  |  Help Center</h1>  
        </div>
    </div>




 

    <!-- Help Section 1 Content -->
    <div class="bg-white max-w-8xl mx-auto p-6 rounded-lg shadow-md">
      <!-- Help Section Title -->
      <h1 class="text-2xl font-bold text-gray-900 mb-4">How to change course section</h1>

      <!-- Instruction Paragraph -->
      <p class="text-gray-700 mb-4">If you need to change the section of a course, follow these steps:</p>
      
      <!-- Step-by-Step Instructions -->
      <ol class="list-decimal list-inside text-gray-700 space-y-2">
        <li>Login to your <a href="https://my.utm.my/" class="text-red-500 underline hover:text-red-700">UTM Portal</a>.</li>
        <li>Under the "Academic" tab, choose "Amendment".</li>
        <li>Select the course you wish to change the section for.</li>
        <li>Press "Delete" if you want to delete the subject. Press "Edit" to change the course section.</li>
        <li>Choose the desired section and confirm the changes.</li>
        <li>Check your updated Course Registration Slip to ensure the changes were applied correctly.</li>
      </ol>
    </div>
  </div>
</section>
@endsection
