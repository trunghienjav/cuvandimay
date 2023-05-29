<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('q');
        $data = Course::where('name', 'like', '%'.$search.'%')
        ->paginate(5);
        $data->appends(['q' => $search]);//them vao de search theo pagination

        return view('course.index', [
            'data' => $data,
            'search' => $search,
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
    public function store(StoreRequest $request)
    {
        $object = new Course();
        // $object->name = $request->get('name');
        $object->fill($request->validated()); //thay thế cho cách trên, nhưng cái name được đẩy lên từ form phải trùng vs trong table, buổi 9, 53:00
        $object->save();

        // Course::create($request->validated()); //dùng validated này thì ko cần except token nữa. Cái vali này là dựa theo khai báo bên StoreReq

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

    public function update(UpdateRequest $request, Course $course)
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
    public function destroy(DestroyRequest $request, $course)
    {
        // $course->delete();
        Course::destroy($course);

        return redirect()->route('course.index');
    }
}
