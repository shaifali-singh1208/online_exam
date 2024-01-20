@extends('admin.main.main')

@section('admin-content')
@if (Session::has('success'))
    <div id="success-message" class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div id="error-message" class="alert alert-danger" role="alert">
        {{ Session::get('error') }}
    </div>
@endif

<style>


h4.text-center {
    color: navy;
    font-size: 30px;
    font-weight: bold;
}
    </style>

            <h4 class="text-center">All Test Details View Here</h4>
    <table class="table table-bordered  table-striped m-4" id="myTable">

        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th> Celpip Id </th>
                <th> Paid_type</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

            @php
                $i = 1;
            @endphp
            @foreach ($para as $emp)
                <tr class="table-info">
                    <td>{{ $i++ }}</td>
                    @php
                        $testIds = explode(',', $emp->test_ids);
                        $numberOfTestIds = count($testIds);
                    @endphp
                    <td>{{ $numberOfTestIds }}</td>
                    <td> {{ $emp->paid_type }} </td>
                       <td> <a href="all_para/{{ $emp->id }}" class="btn btn-success my-2">View</a>
                       
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
@endsection
