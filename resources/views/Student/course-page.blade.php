@extends('Student/student')
@section('Subcontent')


<div class="w-full p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">{{$contents[0]->title}}</h5>
    <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Stay up to date and move work forward with Flowbite on iOS & Android. Download the app today.</p>
</div>
<div class="container flex flex-wrap flex-grow mx-auto mt-10 mb-10 justify-center items-center">
        @if ($contents->hasMorePages())
        <p class="mb-3 text-gray-500 dark:text-gray-400">{{$contents[0]->content}}</p>
        @else
        <p class="mb-3 text-gray-500 dark:text-gray-400">{{$contents[0]->content}}</p>
        <a href="{{route('student-usercourses')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selesai</a>
        @endif
</div>
<div class="container m-5 flex flex-wrap flex-grow mx-auto mt-10 mb-10 justify-center items-cente" id="product">
    {{ $contents->links() }}
</div>
@endsection




