@extends('layout.master')
@section('content')
    <div class="form-group form-outline w-75">
        <form action="{{ route('course.store') }}" method="post">
            @csrf
            Name
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
            {{-- old() là làm xuất hiện lại dữ liệu cũ --}}

            {{-- in ra lỗi --}}
            @if ($errors->has('name'))
                <span class="error" style="color: red">
                    {{ $errors->first('name') }}
                </span>
                <br>
            @endif
            <br>
            <button class="btn btn-success">Thêm</button>
        </form>
    </div>
@endsection
