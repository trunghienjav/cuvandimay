<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::group([
    'middleware' => CheckLoginMiddleware::class
], function () {
    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/courses/create', [CourseController::class, 'store'])->name('course.store');
    Route::get('/courses/edit/{course}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/courses/edit/{course}', [CourseController::class, 'update'])->name('course.update');

    Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('course.api.name');

    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/students/create', [StudentController::class, 'store'])->name('student.store');
    Route::get('/students/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/students/edit/{student}', [StudentController::class, 'update'])->name('student.update');

    Route::group(
        [
            'middleware' => CheckSuperAdminMiddleware::class
        ],
        function () {
            Route::delete('/courses/destroy/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
            Route::delete('/students/destroy/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
        }
    );
});
