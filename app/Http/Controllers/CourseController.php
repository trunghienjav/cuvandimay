<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        $data = Course::get();

        return view('course.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $object = new Course();
        // $object->name = $request->get('name');
        $object->fill($request->except('_token')); //thay thế cho cách trên, nhưng cái name được đẩy lên từ form phải trùng vs trong table, token csrf đc đẩy lên cùng nên phải loại nó ra, buổi 9, 53:00
        $object->save();

        return redirect()->route('course.index');
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        return view('course.edit', [
            'each' => $course,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        // $course->update(
        //     $request->except([
        //         '_token',
        //         '_method',
        //     ])
        // );

        $course->fill($request->except('_token'));
        $course->save();
        //2 cách, cách trên là dùng query builder tốc độ nhanh hơn, nhưng cách dưới là dùng eloquent theo oop, khai báo đối tượng, có thể bắt đc event

        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('course.index');
    }
}
