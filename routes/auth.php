<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Models\Content;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin-users');
        Route::get('/admin/managecourses', [AdminController::class, 'courses'])->name('admin-manage-courses');
        Route::get('/admin/edituser/{iduser}', [AdminController::class, 'edit'])->name('admin-edit-user');
        Route::put('/admin/edituser/user/{id}', [AdminController::class, 'update'])->name('admin-user-update');
        Route::delete('/admin/user/delete/{id}', [AdminController::class, 'destroy'])->name('admin-user-delete');
        Route::delete('/admin/course/delete/{id}', [AdminController::class, 'destroycontent'])->name('admin-course-delete');
        Route::get('/admin/adduser', function() {
            return view('Admin/createuser'); })->name('admin-create-user');
        Route::post('/admin/saveuser', [AdminController::class, 'createuser'])->name('admin-save-user');
        Route::get('/admin/createcourse', function() {
            return view('Admin/createcourse'); })->name('admin-create-course');
        Route::post('/admin/savecourse', [AdminController::class, 'createCourse'])->name('admin-save-course');
        Route::get('/admin/createcontent/{idcourse}', [AdminController::class, 'createcontent'])->name('admin-create-content');
        Route::post('/admin/savecontent', [AdminController::class, 'savecontent'])->name('admin-save-content');
        Route::get('/admin/course-detail/{idcourse}', [AdminController::class, 'courseDetail'])->name('admin-course-detail');
        Route::get('/admin/confirmation/{id}', [AdminController::class, 'confirmation'])->name('admin-confirmation');      
        Route::get('/admin/editcourse/{idcourse}', [AdminController::class, 'editcourse'])->name('admin-edit-course');  
        Route::put('/admin/editcourse/user/{id}', [AdminController::class, 'updatecourse'])->name('admin-course-update');

        Route::resource('/admin', ContentController::class)->names([
            'index' => 'admin-show',
            'create' => 'admin-content.create',
            'store' => 'admin-content.store',
            'show' => 'admin-content.show',
            'edit' => 'admin-content.edit',
            'update' => 'admin-content.update',
            'destroy' => 'admin-content.destroy',
        ]);
    });


        Route::middleware('teacher')->group(function () {
            
            Route::resource('/teacher/courses', CourseController::class)->names([
                'index' => 'teacher-courses',
                'create' => 'teacher-course.create',
                'store' => 'teacher-course.store',
                'show' => 'admin-course.show',
                'edit' => 'teacher-course.edit',
                'update' => 'teacher-course.update',
                'destroy' => 'teacher-course.destroy',
            ]);
        
            Route::resource('/teacher/contents', ContentController::class)->names([
                'index' => 'admin-show-contents',
                
                'store' => 'teacher-content.store',
                'show' => 'admin-content.show',
                'edit' => 'teacher-content.edit',
                'update' => 'teacher-content.update',
                'destroy' => 'teacher-content.destroy',
            ]);

            Route::get('/teacher/contents/create-content/{idcourse}', [ContentController::class, 'createContent'])->name('teacher-add-content');
            Route::get('/teacher/courses/confirmation/{id}', [AdminController::class, 'confirmation'])->name('teacher-confirmation'); 
            Route::get('/teacher/course-detail/{idcourse}', [AdminController::class, 'courseDetail'])->name('teacher-course-detail');
        });

        Route::middleware('student')->group(function () {
            
            Route::resource('/student/courses', CourseController::class)->names([
                'index' => 'student-courses',
                'create' => 'teacher-course.create',
                'store' => 'teacher-course.store',
                'show' => 'admin-course.show',
                'edit' => 'teacher-course.edit',
                'update' => 'teacher-course.update',
                'destroy' => 'teacher-course.destroy',
            ]);
        
            Route::resource('/teacher/contents', ContentController::class)->names([
                'index' => 'admin-show-contents',
                
                'store' => 'teacher-content.store',
                'show' => 'admin-content.show',
                'edit' => 'teacher-content.edit',
                'update' => 'teacher-content.update',
                'destroy' => 'teacher-content.destroy',
            ]);

            Route::get('/teacher/contents/create-content/{idcourse}', [ContentController::class, 'createContent'])->name('teacher-add-content');
            Route::get('/teacher/courses/confirmation/{id}', [AdminController::class, 'confirmation'])->name('teacher-confirmation'); 
            Route::get('/teacher/course-detail/{idcourse}', [AdminController::class, 'courseDetail'])->name('teacher-course-detail');
        });
});
