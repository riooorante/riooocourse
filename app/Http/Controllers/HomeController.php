<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('Admin/dashboard');
            } elseif (Auth::user()->role == 'teacher') {
                return view('Teacher/dashboard');
            } elseif (Auth::user()->role == 'student'){
                return view('Student/dashboard');
            }
        }
        return view('guess/home');
    }

    public function pricing() {
        return view('guess/pricing');
    }

    public function courses() {
        if (request('search')) {
            $data = User::join('courses', 'users.id', '=', 'courses.teacher_id')->where('course_name', 'like', '%'. request('search') . '%' )
            ->select('users.name', 'courses.*')->paginate(20)->withQueryString();
        } else {
            $data = User::join('courses', 'users.id', '=', 'courses.teacher_id')
            ->select('users.name', 'courses.*')->paginate(20)->withQueryString();
        }

        return view('guess/courses', ['courses' => $data]);
    }
}