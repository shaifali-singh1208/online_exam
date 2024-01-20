@extends('experts.main.main')

@section('experts-content')
<style>
    a {
        text-decoration: none;
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Zebra striping */
    tr:nth-of-type(odd) {
        background: #eee;
    }

    th {
        background: #333;
        color: white;
        font-weight: bold;
    }

    td,
    th {
        padding: 6px;
        border: 1px solid #ccc;
        text-align: left;
    }
</style>

<div class="card">
    <div class="card-title" style="background-color:#4B49AC;">
        <h4 class="text-white ml-3">Speaking questions and Answer</h4>
    </div>
</div>

<h4 class="card-title"></h4>
<form action="{{ url('') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $celpip->first()->id }}">
    <input type="hidden" name="id" value="{{ $test->first()->id }}"> <!-- Rest of the form -->
</form>

<h4 class="card-title">Questions</h4>
<div class="table-responsive">
    <table class="table" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>ID</th>
                <th>Question</th>
                <th>Speak_Time</th>
                <th>Prep_Time</th>
                <th>Img1</th>
                <th>Img2</th>
                <th>Img3</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->question }}</td>
                <td>{{ $question->time }}</td>
                <td>{{ $question->prep_time }}</td>
                <td>
                    @if($question->img1)
                    <a href="{{  $question->img1 }}" download class="btn btn-info">
                        Download Image
                    </a>
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    @if($question->img1)
                    <a href="{{  $question->img2 }}" download class="btn btn-info">
                        Download Image
                    </a>
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    @if($question->img1)
                    <a href="{{  $question->img3 }}" download class="btn btn-info">
                        Download Image
                    </a>
                    @else
                    No Image
                    @endif
                </td>
                <td>
                    <a href="{{ url('speaking_ques/speaking_answer/speaking_ans', ['id'=> $celpip->id,'test_id' => $test->id, 'question_id' => $question->id,]) }}"
                        class="btn btn-success my-2">View Answer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
