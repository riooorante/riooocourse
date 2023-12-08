@extends('Admin/admin')
@section('Subcontent')
    <div class="mt-10 m-4">
       

        <div class="m-3 flex items-center justify-center">                   
                <form role="search" action="{{ route('admin-users')}}">
                    <div class="flex">
                        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                        <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">All categories <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg></button>
                        
                        <div class="relative w-full">
                            <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" 
                            placeholder="Search Mockups, Logos, Design Templates..."  name="search" value="<?php echo request('search')?>">
                            <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('admin-create-user') }}" class="ml-2 inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+ Add User</a>
        </div> 
    </div>

    <div class="container flex flex-wrap mx-auto mt-10 mb-10 justify-center items-center">
        

        @if(count($users) > 0)
        @foreach ($users as $user) 
            <div class="w-full m-10 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="pt-10 flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="../images/{{$user->role}}.jpg" alt="Bonnie image"/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->name}}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ucwords($user->role)}}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{($user->email)}}</span>
                    <div class="flex mt-4 md:mt-6">
                        <a href="{{ route('admin-edit-user', ['iduser' => $user->id]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit User</a>
                        <form action="{{ route('admin-user-delete', ['id' => $user->id]) }}" method="POST" onsubmit=" return confirm('Are you sure you want to delete?') ">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }} 
                            <button type="submit" class="ml-9 inline-flex items-center px-4 py-2 text-sm text-red-600 bg-gray-100 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
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

@endsection


