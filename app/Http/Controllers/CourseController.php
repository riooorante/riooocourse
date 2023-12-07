<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('Admin/dashboard');
            } elseif (Auth::user()->role == 'teacher') {
                $query = User::join('courses', 'users.id', '=', 'courses.teacher_id')
                ->where('users.id', '=', Auth::user()->id)
                ->select('users.name', 'courses.*');
            
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where('course_name', 'like', '%' . request('search') . '%')
                            ->orWhere('users.id', '=', Auth::user()->id);
                    });
                }
                $data = $query->paginate(10)->withQueryString();
                
                return view('Teacher/courses', ['courses' => $data]);

            } elseif (Auth::user()->role == 'student'){
                $userId = Auth::user()->id;

                $query = User::join('courses', 'users.id', '=', 'courses.teacher_id')
                    ->select('users.name', 'courses.*')
                    ->whereNotIn('courses.id', function ($subquery) use ($userId) {
                        $subquery->select('course_id')
                            ->from('user_course')
                            ->where('user_id', '=', $userId);
                    });

                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where('course_name', 'like', '%' . request('search') . '%');
                    });
                }

                $data = $query->paginate(10)->withQueryString();

                return view('Student/courses', ['courses' => $data]);
            }
        }
        return view('guess/home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('Admin/dashboard');
            } elseif (Auth::user()->role == 'teacher') {
                return view('Teacher/create-course');
            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
       
    }

    public function createcontent(){
        
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('Admin/dashboard');
            } elseif (Auth::user()->role == 'teacher') {
                $request->validate([
                    'course_name' => ['required', 'string', 'max:255'],
                    'start' => ['required', 'date'],
                    'end' => ['required', 'date', 'after_or_equal:start'],
                    'teacher_id' => ['required', 'exists:users,id,role,teacher'],
                    'description' => ['required', 'string'],
                ]);
        
                $user = Course::create([
                    'course_name' => $request->course_name,
                    'start_date' => $request->start,
                    'end_date' => $request->end,
                    'teacher_id' => $request->teacher_id,
                    'description' => $request->description,
                ]);
        
                $idcourse = Course::latest()->value('id');
                return redirect(route('teacher-add-content', ['idcourse' => $idcourse]));

            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $data = Course::where('id', $id)->get();
                return view('Teacher/edit-course', [
                    'data' => $data
                ]);
            } elseif (Auth::user()->role == 'teacher') {
                $data = Course::where('id', $id)->get();
                return view('Teacher/edit-course', [
                    'data' => $data
                ]);

            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $request->validate([
                    'course_name' => ['required', 'string', 'max:255'],
                    'start' => ['required', 'date'],
                    'end' => ['required', 'date', 'after_or_equal:start'],
                    'teacher_id' => ['required', 'exists:users,id,role,teacher'],
                    'description' => ['required', 'string'],
                ]);
        
                $course = Course::find($id);
        
                $course->update([
                    'course_name' => $request->course_name,
                    'start_date' => $request->start,
                    'end_date' => $request->end,
                    'teacher_id' => $request->teacher_id,
                    'description' => $request->description,
                ]);
        
                $query = User::join('courses', 'users.id', '=', 'courses.teacher_id')
                    ->select('users.name', 'courses.*');
        
                if (request('search')) {
                    $query->where('course_name', 'like', '%' . request('search') . '%');
                }
        
                $data = $query->paginate(20)->withQueryString();
        
                return view('Admin/course', ['courses' => $data]);
            } elseif (Auth::user()->role == 'teacher') {
                $request->validate([
                    'course_name' => ['required', 'string', 'max:255'],
                    'start' => ['required', 'date'],
                    'end' => ['required', 'date', 'after_or_equal:start'],
                    'teacher_id' => ['required', 'exists:users,id,role,teacher'],
                    'description' => ['required', 'string'],
                ]);
        
                $course = Course::find($id);
        
                $course->update([
                    'course_name' => $request->course_name,
                    'start_date' => $request->start,
                    'end_date' => $request->end,
                    'teacher_id' => $request->teacher_id,
                    'description' => $request->description,
                ]);
        
                $query = User::join('courses', 'users.id', '=', 'courses.teacher_id')
                ->where('users.id', '=', Auth::user()->id)
                ->select('users.name', 'courses.*');
            
                if (request('search')) {
                    $query->where(function ($query) {
                        $query->where('course_name', 'like', '%' . request('search') . '%')
                            ->orWhere('users.id', '=', Auth::user()->id);
                    });
                }
            
                $data = $query->paginate(10)->withQueryString();
                
                return view('Teacher/courses', ['courses' => $data]);

            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $data = Course::find($id);
                $data->delete();
        
                return redirect(route('admin-manage-courses'));
            } elseif (Auth::user()->role == 'teacher') {
                $data = Course::find($id);
                $data->delete();
        
                return redirect(route('teacher-courses'));
            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
    }
}
