<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function users()
    {
        $query = User::where('role', '<>', 'admin');

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('role', 'like', '%' . request('search') . '%');
            });
        }

        $data = $query->paginate(20)->withQueryString();

        return view('Admin/usersadmin', ['users' => $data]);
    }

    public function courses()
    {
        $query = User::join('courses', 'users.id', '=', 'courses.teacher_id')
            ->select('users.*', 'courses.*');

        if (request('search')) {
            $query->where('course_name', 'like', '%' . request('search') . '%')->orWhere('role', 'like', '%'.request('search').'%');
        }

        $data = $query->paginate(20)->withQueryString();

        return view('Admin/course', ['courses' => $data]);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,teacher,student']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        $data = User::where('role', '<>', 'admin')->paginate(20)->withQueryString();
        return view('Admin/usersadmin', ['users' => $data]);
    }

    public function createCourse(Request $request)
    {
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
        return redirect(route('admin-create-content', ['idcourse' => $idcourse]));
    }

    public function createcontent($idcourse)
    {
        return view('Admin/createcontent', ['idcourse' => $idcourse]);
    }

    public function savecontent(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string']
        ]);

        $content = Content::create([
            'title' => $request->title,
            'content' => $request->content,
            'course_id' => $request->course_id
        ]);

        return view('Admin/createcontent', ['idcourse' => $request->course_id]);
    }

    public function edit(string $id)
    {
        $data = User::where('id', $id)->get();
        return view('Admin/edituser', [
            'data' => $data
        ]);
    }

    public function editcourse(string $id)
    {
        $data = Course::where('id', $id)->get();
        return view('Admin/edit-course', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $data = User::join('courses', 'users.id', '=', 'courses.teacher_id')
            ->select('users.name', 'courses.*')->paginate(20)->withQueryString();

        return redirect(route('admin-users', ['courses' => $data]));
    }

    public function updateCourse(Request $request, $id)
    {
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
    }

    public function courseDetail($idcourse)
    {

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $course = Course::find($idcourse);
                $content = Content::where('course_id', $idcourse)->get();

                return view('Admin/course-detail', ['course' => $course, 'content' => $content]);
            } elseif (Auth::user()->role == 'teacher') {
                $course = Course::find($idcourse);
                $content = Content::where('course_id', $idcourse)->get();

                return view('Teacher/course-detail', ['course' => $course, 'content' => $content]);

            } elseif (Auth::user()->role == 'student') {
                return view('Student/dashboard');
            }
        }
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        $data1 = User::join('courses', 'users.id', '=', 'courses.teacher_id')
            ->select('users.name', 'courses.*')->paginate(20)->withQueryString();

        return redirect(route('admin-users', ['courses' => $data1]));
    }

    public function destroycontent($id)
    {
        $data = Course::find($id);
        $data->delete();

        return redirect(route('admin-manage-courses'));
    }

    public function confirmation($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $course = Course::find($id);
                $contents = Content::where('course_id', $id)->get();

                return view('Admin/confirm', ['course' => $course, 'content' => $contents]);
            } elseif (Auth::user()->role == 'teacher') {
                $course = Course::find($id);
                $contents = Content::where('course_id', $id)->get();

                return view('Teacher/confirmation', ['course' => $course, 'content' => $contents]);

            } elseif (Auth::user()->role == 'student') {
                return view('Student/dashboard');
            }
        }

    }
}