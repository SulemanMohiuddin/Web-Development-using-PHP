<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\admin;


//home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

//login routes
Route::get('/login',[LoginController::class, 'show'] )->name('login');
Route::get('/register', function () {
    return view('signup');
})->name('register');

Route::post('/login', [LoginController::class, 'redirect'])->name('loginSubmit');
Route::post('/register', [LoginController::class, 'regs'] )->name('signup');

//dashboard routes
Route::get('/dashboard', [admin::class, 'index'])->name('dashboard');
Route::get('/Student_Dashboard', [admin::class, 'index2'])->name('dashboard2');

//admin routes
Route::get('/update', [admin::class, 'show'])->name('update');
Route::post('/update/{id}', [admin::class, 'update'])->name('update.submit');
Route::delete('/delete/{id}', [admin::class, 'delete'])->name('delete');
Route::get('/offer-course', [admin::class, 'offer'])->name('offer.course'); 
Route::post('/offer-course', [admin::class, 'course'])->name('course.offer');
Route::get('/assign-courses', [admin::class, 'showAssignForm'])->name('assign.courses');
Route::post('/assign-courses', [admin::class, 'assignCourses'])->name('assign.courses.submit');

//faculty routes
Route::get('/Add_Attendance', [AttendsController::class, 'selectCourse'])->name('assign.attend');
Route::get('/Add_Attendance/course', [AttendsController::class, 'addAttend'])->name('assign.attend.stud');
Route::post('/Update_Attendace', [AttendsController::class, 'submitAtten'])->name('attendance.update');
Route::get('/Add_Marks', [AttendsController::class, 'marks'])->name('assign.marks');
Route::get('/Add_Marks/course', [AttendsController::class, 'addMarks'])->name('assign.marks.stud');
Route::post('/Add_Marks/course', [AttendsController::class, 'submitMarks'])->name('ssign.marks.add');


//students routes
Route::get('/Personal_Details', [StudentController::class, 'info'])->name('info');
Route::get('/View_Marks', [StudentController::class, 'marks'])->name('viewMarks');
Route::get('/View_Attendance', [StudentController::class, 'attend'])->name('viewAtten');
Route::get('/Registeration', [StudentController::class, 'reg'])->name('regCourse');
Route::get('/registerC', [StudentController::class, 'sub'])->name('subCourse');