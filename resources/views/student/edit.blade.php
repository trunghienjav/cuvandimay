@extends('layout.master')
@section('content')
    <div class="form-group form-outline w-75">
        <form action="{{ route('student.update', $each) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ $each->name }}">
            <br>
            {{-- old() là làm xuất hiện lại dữ liệu cũ --}}
            <label>Gender</label>
            <br>
            <input type="radio" name="gender" value="0" @if ($each->gender === 0) checked @endif>Nữ&emsp;
            <input type="radio" name="gender" value="1" @if ($each->gender === 1) checked @endif>Nam
            <br>
            <br>
            <label>Birthdate</label>
            <input type="date" name="birthdate" value="{{ $each->birthdate }}">
            <br>
            <label>Status</label>
            <div class="mt-6">
                @foreach ($arrStudentStatus as $option => $value)
                    <div class="custom-control custom-radio">
                        <input type="radio" id="{{ $value }}" name="status" class="custom-control-input"
                            value="{{ $value }}" @if ($each->status === $value) checked @endif>
                        <label class="custom-control-label" for="{{ $value }}">{{ $option }}</label>
                    </div>
                @endforeach
            </div>
            <br>
            <label>Avatar</label>
            <br>
            <img src="{{ public_path() }}/{{ $each->avatar }}" height="100" width="100">
            <br>
            <br>
            <input type="file" name="avatar">
            <input type="hidden" name="old_photo" value="{{ public_path() }}/{{ $each->avatar }}">
            <br>
            <br>
            <label>Course</label>
            <br>
            <select name="course_id">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" @if ($course->id === $each->course_id) selected @endif>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            <br>
            <br>
            <button class="btn btn-primary">Edit</button>
        </form>
    </div>
@endsection
