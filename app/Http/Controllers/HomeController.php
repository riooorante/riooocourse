<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('Admin/dashboard');
            } elseif (Auth::user()->role == 'teacher') {
                $courses = Course::where('teacher_id', Auth::user()->id)->get();
                return view('Teacher/dashboard');
            } elseif (Auth::user()->role == 'student') {
                return view('Student/dashboard');
            }
        }

        $courses = DB::table('courses')
            ->leftJoin('user_course', 'courses.id', '=', 'user_course.course_id')
            ->join('users as student', 'user_course.user_id', '=', 'student.id')
            ->orderBy('jumlah_peserta', 'desc')
            ->limit(5)
            ->select(
                'courses.id',
                'courses.course_name',
                'courses.description',
                'courses.start_date as tanggal_mulai',
                'courses.end_date as tanggal_selesai',
                'courses.teacher_id',

                DB::raw('COUNT(user_course.id) as jumlah_peserta')
            )
            ->groupBy(
                'courses.id',
                'courses.course_name',
                'courses.description',
                'courses.start_date',
                'courses.end_date',
                'courses.teacher_id',
            )
            ->get();

        return view('guess/home', ['courses' => $courses]);
    }

    public function pricing()
    {
        return view('guess/pricing');
    }

    public function courses()
    {
        if (request('search')) {
            $data = User::join('courses', 'users.id', '=', 'courses.teacher_id')->where('course_name', 'like', '%' . request('search') . '%')
                ->select('users.name', 'courses.*')->paginate(20)->withQueryString();
        } else {
            $data = User::join('courses', 'users.id', '=', 'courses.teacher_id')
                ->select('users.name', 'courses.*')->paginate(20)->withQueryString();
        }

        return view('guess/courses', ['courses' => $data]);
    }
}