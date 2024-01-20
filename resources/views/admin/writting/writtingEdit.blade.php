@extends('admin.main.main')

@section('admin-content')
    <div class="table-responsive">
        <form action="{{ url('') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <!-- Rest of the form -->

        </form>

        <table class="table table-bordered  table-striped" id="myTable">

            <thead>
                <tr class="table-danger">
                    <th>S.No.</th>
                    <th> Question </th>
                    <th> Time</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

                @php
                    $i = 1;
                @endphp
                @foreach ($writingTest as $emp)
                    <tr class="table-info">
                        <td>{{ $i++ }}</td>
                        <td>{{ $emp->question }}</td>
                        <td> {{ $emp->time }} </td>

                        <td> <a href="{{ url('edit_para/edit-writting/writting_edit_test') }}/{{ $emp->id }}"
                                class="  btn btn-success my-2">Edit</a>
                            <a href="{{ url('edit_para/edit-writting/writting_edit_test/write_ques') }}/{{ $emp->id }}"
                                class="btn btn-danger my-2" onclick="return confirmDelete()">Delete</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete Writting Questions");
        }
    </script>
@endsection
