@extends('admin.main.main')

@section('admin-content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


            <h4 class="edit-para">Edit/Update Paragraph </h4>
    <div class="col-12 grid-margin stretch-card mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-description">

                </p>
                <form action="{{ url('edit-paragraph-ques') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">

                    <div class="form-group">
                        <label for="exampleInputName1">paragraph</label>
                        <textarea type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                            value="" name="paragraph[]">{{ $data->paragraph }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Para_img</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="para_img[]" class="form-control file-upload-info"
                                value="{{ $data->para_img }} " placeholder=" ">
                            <span class="input-group-append">
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">update</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
                <h4 class="edit-para mb-4" >Questions Related to the Paragraph</h4>
                    <table id="myTable" class="mt-4">
                        <thead>
                            <tr class="table-danger">
                                <th>ID</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Time</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr class="table-info">
                                    <td>{{ $question->id }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->options }}</td>
                                    <td>{{ $question->time }}</td>
                                    <td>{{ $question->answer }}</td>
                                    <td>
                                        {{-- <a href="/edit_para_ques/{{ $question->id }}" class="btn btn-success my-2">Edit</a> --}}
                                        <a href="{{url('edit_para/edit-paragraph/paragraph_edit_test/ques')}}/{{ $question->id }}" class="btn btn-success my-2">Edit</a>
                                        <a href="{{url('edit_para/edit-paragraph/paragraph_edit_test/ques/paragraph_ques')}}/{{ $question->id }}" class="btn btn-danger my-2"
                                            onclick="return confirmDelete()">Delete
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
@endsection

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete Paragraph questions");
    }
</script>