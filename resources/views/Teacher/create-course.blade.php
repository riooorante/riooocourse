@extends('Teacher/teacher')
@section('Subcontent')
    <div class="mt-20 m-4">
        <div>
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        
                        <span class="me-2">1</span>
                        Create <span class="hidden sm:inline-flex sm:ms-2">Course</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="me-2">2</span>
                        Add <span class="hidden sm:inline-flex sm:ms-2">Content</span>
                    </span>
                </li>
                <li class="flex items-center">
                    <span class="me-2">3</span>
                    Confirmation
                </li>
                </ol>
        </div>
        <div class="mt-10">
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white flex items-center justify-center">Create New Course</h2>
                    <form method="POST" action="{{ route('teacher-course.store') }}">
                        @csrf
                    
                        <div class="sm:col-span-2">
                            <x-input-label for="course_name" :value="__('Course Name')" />
                            <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" :value="old('course_name')" required />
                            <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                        </div>
                        
                        <div class="w-full mt-4">
                            <x-input-label for="teacher_id" :value="__('Lecture Id')" />
                            <x-text-input id="teacher_id" class="block mt-1 w-full" type="number" name="teacher_id" :value="Auth::user()->id" readonly />
                            <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                        </div>
                        
                        
                        <div class="mt-4">
                            <x-input-label for="start" :value="__('Start')" />
                            <input id="start" class="block mt-1 w-full" type="date" name="start" :value="old('start')" required />
                            <x-input-error :messages="$errors->get('start')" class="mt-2" />
                        </div>
                        
                        <div class="mt-4">
                            <x-input-label for="end" :value="__('End')" />
                            <input id="end" class="block mt-1 w-full" type="date" name="end" :value="old('end')" required />
                            <x-input-error :messages="$errors->get('end')" class="mt-2" />
                        </div>
                        
                        <div class="sm:col-span-2 mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Add Course') }}
                            </x-primary-button>
                        </div>
                    </form>
                    
                </div>
              </section>
        </div>     
    </div>
  
@endsection


