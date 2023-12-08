@extends('Teacher/teacher')
@section('Subcontent')


<div class="top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" style="margin: 150px 100px 0px 500px">
    <h1 class="flex flex-wrap font-extrabold leading-none tracking-tight text-gray-900 justify-center items-center md:text-5xl lg:text-6xl dark:text-white">{{$course->course_name}}</h1>
</div>

<div class="container flex flex-wrap mx-auto mb-10 justify-center items-center" >
    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">{{$course->description}}</p>
    <a href="{{ route('teacher-add-content', ['idcourse' => $course->id]) }}" class="m-4 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        + Add New Content
    </a>;
</div>

        @if(count($content) > 0)
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
                    @foreach ($content as $content)
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
                            <td class="flex px-6 py-4">
                                <a href="{{route('teacher-content.edit', $content->id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit Content</a>
                                <form action="{{ route('teacher-content.destroy', ['content' => $content->id]) }}" method="POST" onsubmit=" return confirm('Are you sure you want to delete {{$content->id}}?') ">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }} 
                                    <button type="submit" class="ml-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Delete
                                    </button>
                                </form>
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


