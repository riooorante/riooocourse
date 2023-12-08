@extends('layout')
@section('content')

@include('components.navbarguess')
<div>
    <section class="bg-center bg-no-repeat bg-cover bg-[url('https://news.tcc.edu/wp-content/uploads/2019/04/iStock-813019744.jpg')] bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Inspiring Curiosity, Fostering Expertise: Your Academic Adventure Awaits</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Embark on an enriching academic adventure with us, where we inspire curiosity, foster expertise, and pave the way for your skill mastery, ensuring that your journey in learning not only ignites passion but also transforms aspirations into tangible achievements.</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="{{route('login')}}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Get started
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    
<h1 class="mt-10 text-4xl font-extrabold text-center tracking-tight leading-none text-dark md:text-5xl lg:text-6xl">Top Courses</h1>
<div class="container flex flex-wrap mx-auto mt-10 mb-10 justify-center items-center">
     @if(count($courses) > 0)
            @foreach ($courses as $course)
            <div class="max-w-sm m-10 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 h-64 flex flex-col justify-center">
                <div class="p-5 text-center">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$course->course_name}}</h5>
                    </a>
                    <div class="container flex flex-wrap mx-auto justify-center items-center">
                        <a href="{{route('login')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Read more
                        </a>
                    </div>
                </div>
            </div>
            
            @endforeach
        @else
        <p class="flex flex-wrap mx-auto mt-10 mb-10 justify-center items-center">No contents available</p>
        @endif
</div>
    <div class="flex justify-center">
        <div class="mx-auto m-8">
            @include('components.statistics')
        </div>
    </div>
</div>

@endsection