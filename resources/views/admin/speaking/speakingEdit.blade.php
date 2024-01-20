@extends('admin.main.main')

@section('admin-content')


    
<div class="table-responsive">
    <form action="{{ url('') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <!-- Rest of the form -->
    </form>

    <table class="table  table-striped" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th>Question</th>
                <th>Img1</th>
                <th>Img2</th>
                <th>Img3</th>
                <th>speak_time</th>
                <th>prep_Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($speakingTest as $emp)
                <tr class="">
                    <td>{{ $i++ }}</td>
                    <td>{{ $emp->question }}</td>
                    <td>
                        @if($emp->img1)
                        <a href="{{  $emp->img1 }}" download class="btn btn-info">
                            Download Image
                        </a>
                        @else
                        No Image
                        @endif
                    </td>
                    <td>
                        @if($emp->img1)
                        <a href="{{  $emp->img2 }}" download class="btn btn-info">
                            Download Image
                        </a>
                        @else
                        No Image
                        @endif
                    </td>
                    <td>
                        @if($emp->img3)
                        <a href="{{  $emp->img3 }}" download class="btn btn-info">
                            Download Image
                        </a>
                        @else
                        No Image
                        @endif
                    </td>
                    <td>{{ $emp->prep_time }}</td>
                    <td>{{ $emp->time }}</td>
                    <td>
                        <a href="{{ url('edit_para/edit-speaking/speaking_edit_test') }}/{{ $emp->id }}" class="btn btn-success my-2">Edit</a><br>
                        <a href="{{ url('edit_para/edit-speaking/speaking_edit_test/speaking_ques') }}/{{ $emp->id }}" class="btn btn-danger my-2" onclick="return confirmDelete()">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete Speaking Questions");
    }
</script>

@endsection
