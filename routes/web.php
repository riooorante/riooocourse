<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::redirect('/', '/home');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses');

Route::get('/tes', function() {
    return view('Admin/confirm'); })->name('tes');
// Route::middleware('admin')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });


// Route::middleware('teacher')->group(function () {
//     Route::get('/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
// });


// Route::middleware('student')->group(function () {
//     Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
// });
