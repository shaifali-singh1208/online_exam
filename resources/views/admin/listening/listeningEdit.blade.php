@extends('admin.main.main')

@section('admin-content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="card mb-4">
    <div class="card-tittle " style="background-color:#4B49AC;">
        <h4 class="text-white ">Update Audio Quesions</h4>
    </div>
</div>
<form action="{{ url('') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <!-- Rest of the form -->

</form>
<table class="table table-bordered  table-striped m-4" id="myTable">

    <thead>
        <tr class="table-danger">
            <th>S.No.</th>
            <th> Question </th>
            <th> Audio_link</th>
            <th> time </th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>

        @php
            $i = 1;
        @endphp
        @foreach ($listen as $emp)
            <tr class="table-info">
                <td>{{ $i++ }}</td>
                <td>{{ count(explode(',', $emp->question_ids)) }}</td>
                
                <td>{{ ucwords($emp->audio_link) }}</td>
                <td> {{ $emp->time }} </td>
                <td> <a href="{{url('edit_para/edit-listening/listening_edit_test/question')}}/{{ $emp->id }}" class="btn btn-success my-2">Edit</a>
                </a>
                </td>
            </tr>
        @endforeach


    </tbody>
</table>



<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete employee");
    }
</script>



</div>







@endsection