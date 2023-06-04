@extends('layout.master')
@section('content')
<div class="form-group form-outline w-75">
    <form action="{{ route('course.update', $each) }}" method="post">
        @csrf
        @method('put')
        Name
        <input class="form-control" type="text" name="name" value="{{ $each->name }}">
        @if ($errors->has('name'))
            <span class="error">
                {{ $errors->first('name') }}
            </span>
        @endif
        <br>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
