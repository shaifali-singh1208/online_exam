@extends('experts.main.main')

@section('experts-content')
@if (Session::has('success'))
<div id="success-message" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif 

    <h4> Speaking Test Question here</h4>

    <table class="table table-bordered table-striped m-4" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th>Celpip_Id</th>
                <th>Test_ids</th>
                <th>paid_type</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @if ($questions->count() > 0)
                @php $i = 1;

                @endphp

                @foreach ($questions as $emp)
                    <tr class="table-info">
                        <td>{{ $i++ }}</td>
                        <td>{{ $emp->id }}</td>

                        <td>{{ count(explode(',', $emp->test_ids)) }}</td>
                        <td>{{ $emp->paid_type }}</td>
                        <td>
                            <a href="{{ url('speaking_ques') }}/{{ $emp->id }}" class="btn btn-success my-2">Edit</a>
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



 

</div>

@endsection
