@extends('Admin/admin')
@section('Subcontent')

<h1 class="mb-4 text-4xl flex flex-wrap font-extrabold leading-none tracking-tight text-gray-900 justify-center items-center md:text-5xl lg:text-6xl dark:text-white">{{$course->course_name}}</h1>

<div class="container flex flex-wrap mx-auto mt-10 mb-10 justify-center items-center">
    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">{{$course->description}}</p>
    <a href="{{ route('admin-create-content', ['idcourse' => $course->id]) }}" class="m-4 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        + Add New Content
    </a>
</div>

        @if(count($contents) > 0)
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $content)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('../images/student.jpg') }}" alt="Jese image">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $content->title }}</div>
                                </div>  
                            </th>
                            <td class="px-6 py-4">
                                On Progress
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit Content</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="flex flex-wrap mx-auto mt-10 mb-10 justify-center items-center">No contents available</p>
        @endif



@endsection


