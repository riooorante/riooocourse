@extends('Admin/admin')
@section('Subcontent')
<div class="w-100 h-100">
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white flex items-center justify-center">Create New Course</h2>
                    <form method="POST" action="{{ route('admin-course-update', $data[0]->id) }}">
                        @method("PUT")
                        @csrf
                        <div class="sm:col-span-2">
                            <x-input-label for="course_name" :value="__('Course Name')" />
                            <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" :value="$data[0]->course_name" required />
                            <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                        </div>
                        <div class="w-full mt-4">
                            <x-input-label for="teacher_id" :value="__('Lecture Id')" />
                            <x-text-input id="teacher_id" class="block mt-1 w-full" type="number" name="teacher_id" :value="$data[0]->teacher_id" required />
                            <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="start" :value="__('Start')" />
                            <input id="start" class="block mt-1 w-full" type="date" name="start" value="{{$data[0]->start_date}}" required />
                            <x-input-error :messages="$errors->get('start')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="end" :value="__('End')" />
                            <input id="end" class="block mt-1 w-full" type="date" name="end" value="{{$data[0]->end_date}}" required />
                            <x-input-error :messages="$errors->get('end')" class="mt-2" />
                        </div>
                        <div class="sm:col-span-2 mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here">{{ $data[0]->description}}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Save Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </section>
</div>
@endsection


