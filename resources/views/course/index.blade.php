@extends('layout.master')
@section('content')
    <div class="card">
        {{-- nếu có lỗi gì thì nó sẽ in ra cái thể card header này --}}
        @if ($errors->any())
            <div class="card-header">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="card-body">
            <a class="btn btn-success" style="margin-bottom: 1%" href="{{ route('course.create') }}">
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
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($data as $each)
                    <tr>
                        <td>{{ $each->id }}</td>
                        <td>{{ $each->name }}</td>
                        <td>{{ $each->year_created_at }}</td>
                        {{-- <td>{{ $each -> created_at->format('Y-m-d') }}</td> --}}
                        <td>
                            <a class="btn btn-primary" href="{{ route('course.edit', $each) }}">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('course.destroy', $each) }}" method="post">
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
