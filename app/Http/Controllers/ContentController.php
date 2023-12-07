<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createContent($idcourse)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('Admin/create-content', ['idcourse' => $idcourse]);
            } elseif (Auth::user()->role == 'teacher') {
                return view('Teacher/create-content', ['idcourse' => $idcourse]);
            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
    }
    public function create() {

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('Admin/dashboard');
            } elseif (Auth::user()->role == 'teacher') {
                $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'content' => ['required', 'string']
                ]);
        
                $content = Content::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'course_id' => $request->course_id
                ]);
        
                return view('Teacher/create-content', ['idcourse' => $request->course_id]);

            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
        return view('guess/home');
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
                $data = Content::find($id)->get();
                return view('Admin/edit-content', ['data'=>$data]);
            } elseif (Auth::user()->role == 'teacher') {
                $data = Content::find($id)->get();
                return view('Teacher/edit-content', ['data'=>$data]);
            }
        }
        return view('guess/home');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'content' => ['required', 'string']
            ]);
            
                $content = Content::find($id);
                $content->update([
                            'title' => $request->title,
                            'content' => $request->content,]);
                
                $course = Course::find($content->course_id);
                $content = Content::where('course_id', $course->id)->get();
            
            return view('Admin/course-detail', ['course' => $course, 'content' => $content]);
            } elseif (Auth::user()->role == 'teacher') {
                $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'content' => ['required', 'string']
            ]);
            
            $content = Content::find($id);
            $content->update([
                        'title' => $request->title,
                        'content' => $request->content,]);
            
            $course = Course::find($content->course_id);
            $content = Content::where('course_id', $course->id)->get();
            
            return view('Teacher/course-detail', ['course' => $course, 'content' => $content]);
            }
        }
        return view('guess/home');
          
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $content = Content::find($id);
                $course = Course::find($content->course_id);
                $content->delete();
            
                $contentall = Content::where('course_id', $course->id)->get();
                return view('Admin/course-detail', ['course' => $course, 'content' => $contentall]);
            } elseif (Auth::user()->role == 'teacher') {
                $content = Content::find($id);
                $course = Course::find($content->course_id);
                $content->delete();
            
                $contentall = Content::where('course_id', $course->id)->get();
                return view('Teacher/course-detail', ['course' => $course, 'content' => $contentall]);

            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
        return view('guess/home');

       
     }
}