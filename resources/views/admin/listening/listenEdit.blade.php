@extends('admin.main.main')

@section('admin-content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <div class="card">
        <div class="card-tittle " style="background-color:#4B49AC;">
            <h4 class="text-white ml-3">Edit/Update Listening Quesions</h4>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-description">

                </p>
                <form action="{{ url('edit-listening-ques') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">

                    <div class="form-group">
                        <label for="exampleInputName1">Time</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                            value="{{ $data->time }}" name="time[]">
                    </div>
                    <div class="form-group">
                        <label>Audio_link</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="audio_link[]" class="form-control file-upload-info"
                                value="{{ $data->audio_link }} " placeholder=" ">
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
                <h4 class="card-title">Questions Related to the Audio</h4>
                    <table class="table table-bordered  table-striped m-4" id="myTable">
                        <thead>
                            <tr class="table-danger">
                                <th>ID</th>
                                <th>Que_audio</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Time</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                        @endphp
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $question->id }}</td>
                                    <td>
                                        @if(!empty($question->que_audio))
                                            Audio_{{$i}}
                                        @else
                                            {{$question->que_audio}} 
                                        @endif 
                                    </td>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->options }}</td>
                                    <td>{{ $question->time }}</td>
                                    <td>{{ $question->answer }}</td>
                                    <td>
                                        {{-- <a href="/edit_para_ques/{{ $question->id }}" class="btn btn-success my-2">Edit</a> --}}
                                        <a href="{{url('edit_para/edit-listening/listening_edit_test/question/edit/')}}/{{ $question->id }}" class="btn btn-success my-2">Edit</a>
                                        <a href="{{url('edit_para/edit-listening/listening_edit_test/question/edit/listen_ques/')}}/{{ $question->id }}" class="btn btn-danger my-2"
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
        return confirm("Are you sure you want to delete Audio Questions");
    }
</script>