<form action="{{ route('course.update', $each) }}" method="post">
    @csrf
    @method('put')
    Name
    <input type="text" name="name" value="{{ $each->name }}">
    @if ($errors->has('name'))
        <span class="error">
            {{ $errors->first('name') }}
        </span>
    @endif
    <br>
    <button>Update</button>
</form>
