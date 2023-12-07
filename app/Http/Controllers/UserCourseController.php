<?php

namespace App\Http\Controllers;

use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = UserCourse::join('courses', 'user_course.course_id', '=', 'courses.id')
                ->join('users as teacher', 'courses.teacher_id', '=', 'teacher.id')
                ->where('user_course.user_id', '=', Auth::user()->id)
                ->select('teacher.name', 'courses.*');
            
            if (request('search')) {
                $query->where(function ($query) {
                    $query->where('course_name', 'like', '%' . request('search') . '%');
                });
            }
            
            $data = $query->paginate(10)->withQueryString();
            
            return view('Student/mycourses', ['courses' => $data]);
            

        if (request('search')) {
            $query->where(function ($query) {
                $query->where('course_name', 'like', '%' . request('search') . '%')
                    ->orWhere('users.id', '=', Auth::user()->id);
            });
        }

        $data = $query->paginate(10)->withQueryString();
                
        return view('Student/mycourses', ['courses' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = UserCourse::create([
            'user_id' => Auth::user()->id,
            'course_id' => $request->course_id,
        ]);

        return redirect(route('student-courses'));


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
