@extends('Teacher/teacher')
@section('Subcontent')
<div class=" m-4">
    <div class="m-3 flex items-center justify-center">
        <form class="flex items-center" action="{{ route('admin-manage-courses') }}">
            <label for="voice-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejun="round" stroke-width="2" d="M11.15 5.6h.01m3.337 1.913h.01m-6.979 0h.01M5.541 11h.01M15 15h2.706a1.957 1.957 0 0 0 1.883-1.325A9 9 0 1 0 2.043 11.89 9.1 9.1 0 0 0 7.2 19.1a8.62 8.62 0 0 0 3.769.9A2.013 2.013 0 0 0 13 18v-.857A2.034 2.034 0 0 1 15 15Z"/>
                    </svg>
                </div>
                <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Course" name="search" value="{{ request('search') }}">
            </div>
            <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>Search
            </button>
        </form>   
        <a href="{{ route('teacher-course.create') }}" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+ Add Course</a>
    </div>
</div>
<div class="container flex flex-wrap mx-auto mt-10 mb-10 justify-center items-center">
    @if(count($courses) > 0)
        @foreach ($courses as $course)
            <div class="max-w-sm m-10 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$course->course_name}}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Course By {{$course->name}}</p>
                    <div class="container flex flex-wrap mx-auto  justify-center items-center">
                    <a href="{{ route('teacher-course-detail', ['idcourse' => $course->id]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                    </a>
                    <a href="{{ route('teacher-course.edit', ['course' => $course->id]) }}" class="m-4 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Edit
                    </a>
                    <form action="{{ route('teacher-course.destroy', $course->id) }}" method="POST" onsubmit=" return confirm('Are you sure you want to delete?') ">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }} 
                        <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Delete
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <p class="flex flex-wrap mx-auto mt-10 mb-10 justify-center items-center">No contents available</p>
    @endif
</div>
<div class="container d-flex justify-content-center align-items-center h-100 mt-5" id="product">
    {{ $courses->links() }}
</div>
@endsection


