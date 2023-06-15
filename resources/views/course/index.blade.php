@extends('layout.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <a class="btn btn-success" style="margin-bottom: 1%" href="{{ route('course.create') }}">
                Thêm
            </a>
            <div class="form-group">
                <select id="select-name">
                </select>
            </div>
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
                    <th>Number students</th>
                    <th>Edit</th>
                    @if (checkSuperAdmin())
                        <th>Delete</th>
                    @endif
                </tr>
                @foreach ($data as $each)
                    <tr>
                        <td>{{ $each->id }}</td>
                        <td>{{ $each->name }}</td>
                        <td>{{ $each->year_created_at }}</td>
                        <td>{{ $each->students_count }}</td>
                        {{-- đếm số hs có trong lớp, buôi 15, 1:04:50 --}}
                        <td>
                            <a class="btn btn-primary" href="{{ route('course.edit', $each) }}">
                                Edit
                            </a>
                        </td>
                        @if (checkSuperAdmin())
                            <td>
                                <form action="{{ route('course.destroy', $each) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    {{-- xoá thì cần thềm method delete --}}
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        @endif
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

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // var table = $('#select2345').DataTable();
        $("#select-name").select2({
            ajax: {
                url: "{{ route('course.api.name') }}",
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term, // search term
                    };
                },
                processResults: function(data, params) {
                    console.log(data);

                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            },
            placeholder: 'Search for a name',
            // minimumInputLength: 1,
        });

        $("#select-name").change(function() {
            table.column(0).search(this.value).draw();
        });
    </script>
@endpush
