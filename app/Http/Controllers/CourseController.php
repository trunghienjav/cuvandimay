<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{
    private Model $model; //khai báo cái này để khi copy sang chỗ khác thì chỉ cần sửa chỗ này
    public function __construct()
    {
        $this->model = new Course();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $data = $this->model::where('name', 'like', '%' . $search . '%')
            ->paginate(5);
        $data->appends(['q' => $search]); //them vao de search theo pagination

        return view('course.index', [
            'data' => $data,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(StoreRequest $request)
    {
        $object = new Course();
        // $object->name = $request->get('name');
        $object->fill($request->validated()); //thay thế cho cách trên, nhưng cái name được đẩy lên từ form phải trùng vs trong table, buổi 9, 53:00
        $object->save();

        // $this->model::create($request->validated()); //dùng validated này thì ko cần except token nữa. Cái vali này là dựa theo khai báo bên StoreReq

        return redirect()->route('course.create');
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

    public function update(UpdateRequest $request, $courseId)
    {
        // $this->model::where('id', $courseId)->update(
        //     $request->validated()
        // );

        // $course->update(
        //     $request->except([
        //         '_token',
        //         '_method',
        //     ])
        // );
        $object = $this->model->find($courseId);
        $object->fill($request->validated());
        $object->save();
        //2 cách, cách trên là dùng query builder tốc độ nhanh hơn, nhưng cách dưới là dùng eloquent theo oop, khai báo đối tượng, có thể bắt đc event

        return redirect()->route('course.index');
    }

    // public function destroy(DestroyRequest $request, Course $course)
    // {
    //     // dd(1);
    //     // $this->model->find($course)->delete();
    //     // $this->model->where('id', $course)->delete();
    //     // $course->delete();
    //     // $this->model::destroy($course);

    //     // return redirect()->route('course.index');

    //     return back();

    // }
    public function destroy(DestroyRequest $request, $courseId)
    {
        $this->model->find($courseId)->delete();
        // $this->model->where('id', $courseId)->delete();

        // $arr            = [];
        // $arr['status']  = true;
        // $arr['message'] = '';
        //đoạn arr này là sao vẫn chưa hiểu

        return back();
    }
}
