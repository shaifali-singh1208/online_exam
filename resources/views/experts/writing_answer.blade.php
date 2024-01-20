@extends('experts.main.main')

@section('experts-content')

@if(session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<h4> Written Test Question here</h4>
    <table class="table table-bordered table-striped m-4" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th>Celpip_Id</th>
                <th>Test</th>
                <th>paid_type</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @if($questions->count() > 0)
                @php $i = 1;

                 @endphp



                @foreach($questions as $emp)
                    <tr class="table-info">
                        <td>{{ $i++ }}</td>
                        <td>{{$emp->id}}</td>

                        <td>{{ count(explode(',', $emp->test_ids)) }}</td>
                        <td>{{ $emp->paid_type }}</td>
                        <td>
                            <a href="{{url('written_ques')}}/{{ $emp->id }}" class="btn btn-success my-2">Edit</a>
                        </td>
                    </tr>
                    
                @endforeach
            @else
                <tr>
                    <td colspan="4">No questions found.</td>
                </tr>
            @endif
        </tbody>
    </table>



    <!-- {{-- <h4> Speaking Test Question here</h4>

    <table class="table table-bordered table-striped m-4" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th>Id</th>
                <th>Question</th>
                <th>test_type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($data->count() > 0)
                @php $i = 1;
                 @endphp
                @foreach($data as $emp)
                    <tr class="table-info">
                        <td>{{ $i++ }}</td>
                        <td>{{$emp->id}}</td>

                        <td>{{ count(explode(',', $emp->question_ids)) }}</td>
                        <td>{{ $emp->test_type }}</td>
                        <td>
                            <a href="{{url('speaking_ques')}}/{{ $emp->id }}" class="btn btn-success my-2">Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">No questions found.</td>
                </tr>
            @endif
        </tbody>
    </table> --}} -->


@endsection
