@extends('layout.master')
@section('content')
    <a class="btn btn-success" style="margin-bottom: 1%" href="{{ route('student.create') }}">
        Thêm
    </a>
    <form class="float-right form-group form-inline">
        <label class="mr-2">Search:</label>
        <input type="search" name="q" value="{{ $search }}" class="form-control">
    </form>
    <br>
    <table class="table table-striped table-centered mb-0">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Birthdate</th>
            <th>Status</th>
            <th>Avatar</th>
            <th>Course Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($data as $each)
            <tr>
                <td>{{ $each->id }}</td>
                <td>{{ $each->name }}</td>
                <td>{{ $each->gendername }}</td>
                <td>{{ $each->age }}</td>
                <td>
                    {{-- @foreach ($arrStudentStatus as $option => $value)
                        @if ($value === $each->status)
                            {{ $option }}
                        @endif
                    @endforeach
                    //cách này tự làm, tensai daro-, nhưng anh Long bảo ko nên xử lí ở front nên để tham khảo z --}}
                    {{ $each->statusname }}
                </td>
                <td>
                    <img src="{{ public_path() }}/{{$each->avatar}} ">
                </td>
                <td>{{ optional($each->course)->name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('student.edit', $each) }}">
                        Edit
                    </a>
                </td>
                <td>
                    <form action="{{ route('student.destroy', $each) }}" method="post">
                        @csrf
                        @method('DELETE')
                        {{-- xoá thì cần thềm method delete --}}
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <nav>
        <ul class="pagination pagination-rounded mb-0">
            {{ $data->links() }}
        </ul>
    </nav>
    </div>
    </div>
@endsection
