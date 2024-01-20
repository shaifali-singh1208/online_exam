@extends('admin.main.main')

@section('admin-content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <style>
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

            <h4 class="edit-para mb-4">View All Test</h4>
 
    <form action="{{ url('') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <!-- Rest of the form -->

    </form>
    {{-- <div class="table table-bordered  table-striped m-4"> --}}
    <table id="myTable" >

        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th> Question </th>
                <th> Paragraph</th>
                <th> Para_img </th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

            @php
                $i = 1;
            @endphp
            @foreach ($paragraph as $emp)
                <tr class="table-info">
                    <td>{{ $i++ }}</td>
                    <td>{{ count(explode(',', $emp->question_ids)) }}</td>
                    <td>{{ ucwords($emp->paragraph) }}</td>
                    <td> {{ $emp->para_img }} </td>
                    <td> <a href="{{ url('edit_para/edit-paragraph/paragraph_edit_test') }}/{{ $emp->id }}"
                            class=" btn btn-success my-2">Edit</a>
                        </a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
    </div>


    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete employee");
        }
    </script>
@endsection
