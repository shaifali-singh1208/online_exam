@extends('experts.main.main')

@section('experts-content')

    <div class="card">
        <div class="card-title" style="background-color:#4B49AC;">
            <h4 class="text-white ml-3">Written quesions and Answer</h4>
        </div>
    </div>
                <h4 class="card-title"></h4>
                <form action="{{ url('') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $celpip->first()->id }}">
                    <input type="hidden" name="id" value="{{ $test->first()->id }}">

                </form>

    <h4 class="card-title">Questions</h4>
    <table class="table table-bordered table-striped m-4" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>ID</th>
                <th>Question</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question }}</td>

                    {{-- <td>{{ count(explode(',', $question->question_ids)) }}</td> --}}
                    <td>{{ $question->time }}</td>
                    <td>
                        <a href="{{ url('written_ques/written_answer/ques_answer', ['id'=> $celpip->id, 'test_id' => $test->id, 'question_id' => $question->id,]) }}" 
                            class="btn btn-success my-2">View Answer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{-- <button type="button" class="btn btn-primary" >
        Update Result
    </button> --}}
    




   
@endsection
