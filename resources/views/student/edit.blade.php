@extends('layout.master')
@section('content')
<div class="form-group form-outline w-75">
    <form action="{{ route('student.update', $each) }}" method="post">
        @csrf
        @method('put')
        Name
        <input class="form-control" type="text" name="name" value="{{ $each->name }}">
        <br>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
