<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('course.create');
Route::post('/courses/create', [CourseController::class, 'store'])->name('course.store');
Route::delete('/courses/destroy/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
Route::get('/courses/edit/{course}', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/courses/edit/{course}', [CourseController::class, 'update'])->name('course.update');

Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('course.api.name');

Route::get('/students',[StudentController::class, 'index'])->name('student.index');
Route::get('/students/create',[StudentController::class, 'create'])->name('student.create');
Route::post('/students/create',[StudentController::class, 'store'])->name('student.store');
Route::delete('/students/destroy/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
Route::get('/students/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/students/edit/{student}', [StudentController::class, 'update'])->name('student.update');



