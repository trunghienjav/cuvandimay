<a href="{{ route('course.create') }}">
Thêm
</a>
<table border="1" width="100%">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Created At</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    @foreach ( $data as $each)
        <tr>
            <td>{{ $each -> id }}</td>
            <td>{{ $each -> name }}</td>
            <td>{{ $each -> year_created_at }}</td>
            {{-- <td>{{ $each -> created_at->format('Y-m-d') }}</td> --}}
            <td>
                <a href="{{ route('course.edit', $each) }}">
                    Edit
                </a>
            </td>
            <td>
                <form action="{{ route('course.destroy', $each) }}" method="post">
                    @csrf
                    @method('DELETE')
                    {{-- xoá thì cần thềm method delete --}}
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
