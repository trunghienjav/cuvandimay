<?php

namespace App\Http\Controllers;

use App\Enums\StudentStatusEnum;
use App\Http\Requests\Student\StoreRequest;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{
    private Model $model; //khai báo cái này để khi copy sang chỗ khác thì chỉ cần sửa chỗ này
    public function __construct()
    {
        $this->model = new Student();
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr); //viết hoa chữ cái đầu
        $title = implode(' - ', $arr);

        $arrStudentStatus = StudentStatusEnum::getArrayView(); //lấy ra enum
        // dd($arrStudentStatus);
        View::share('title', $title);
        View::share('arrStudentStatus', $arrStudentStatus);
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $data = $this->model::where('name', 'like', '%' . $search . '%')
            ->paginate(5);
        $data->appends(['q' => $search]); //them vao de search theo pagination

        return view('student.index', [
            'data' => $data,
            'search' => $search,
        ]);
    }

    public function create()
    {
        $courses = Course::get();

        return view('student.create', [
            'courses' => $courses,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $path          = Storage::disk('public')->putFile('avatars', $request->file('avatar'));
        $arr           = $request->validated();
        $arr['avatar'] = $path;
        // dd($arr);
        $this->model->create($arr);

        return redirect()->route('student.index')->with('success', 'Đã thêm thành công');
    }

    public function show()
    {
        //
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
