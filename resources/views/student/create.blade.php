@extends('layout.master')
@section('content')
    <div class="form-group form-outline w-75">
        <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
            <br>
            {{-- old() là làm xuất hiện lại dữ liệu cũ --}}
            <label>Gender</label>
            <br>
            <input type="radio" name="gender" value="0" checked>Nữ&emsp;
            <input type="radio" name="gender" value="1">Nam
            <br>
            <label>Birthdate</label>
            <input type="date" name="birthdate">
            <br>
            <label>Status</label>
            <div class="mt-6" >
                @foreach ($arrStudentStatus as $option => $value)
                    <div class="custom-control custom-radio">
                        <input type="radio" id="{{ $value }}" name="status" class="custom-control-input"
                            value="{{ $value }}" @if ($loop->first) checked @endif>
                        <label class="custom-control-label" for="{{ $value }}">{{ $option }}</label>
                    </div>
                @endforeach
            </div>
            <br>
            <label>Avatar</label>
            <input type="file" name="avatar">
            <br>
            <br>
            <label>Course</label>
            <select name="course_id">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            <br>
            <br>
            <button class="btn btn-success">Thêm</button>
        </form>
    </div>
@endsection
