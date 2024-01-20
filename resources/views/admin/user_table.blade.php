
@extends('admin.main.main')

@section('admin-content')
@if (Session::has('success'))
<div id="success-message" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

    <style>
        h4.text-center {
    color: navy;
    font-size: 30px;
    font-weight: bold;
}
        </style>
            <h4 class="  text-center "> User Details</h4>
    <table class="table table-bordered  table-striped m-4" id="myTable">

        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th> Name </th>
                <th> Email</th>
                <th> Phone </th>
                <th> Date </th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

            @php
                $i = 1;
            @endphp
            @foreach ($users as $emp)
                <tr class="table-info">
                    <td>{{ $i++ }}</td>
                    <td>{{ ucwords($emp->name) }}</td>
                    <td> {{ $emp->email }} </td>
                    <td> {{ $emp->number }} </td>
                    <td> {{ $emp->created_at }} </td>

                    <td> <a href="edit_users/{{ $emp->id }}" class="btn btn-success my-2">Edit</a>
                        <a href="delete/{{ $emp->id }}" class="btn btn-danger my-2" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>



    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete Users");
        }
    </script>



@endsection


