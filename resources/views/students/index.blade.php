<h1>Đây là danh sách sinh viên</h1>
<a href="{{ route('create') }}">
    Thêm
</a>
<table border="1" width="100%">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
    </tr>
    @foreach ($students as $student)
        <tr>
            <td>
                {{ $student->id }}
            </td>
            <td>
                {{ $student->name }}
            </td>
            <td>
                {{ $student->birthdate }}
            </td>
            <td>
                {{ $student->gender }}
            </td>
        </tr>
    @endforeach

</table>
