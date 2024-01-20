@extends('admin.main.main')

@section('admin-content')
    <div class="card">
        <div class="card-title" style="background-color:#4B49AC;">
            <h4 class="text-white mb-3">Written Answer</h4>
        </div>
    </div>

    <table class="table table-bordered table-striped mt-4" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>ID</th>
                <th>Question Answer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>    
            <tr>
                <td>
                    {{$question_id}}
                </td>
                <td>
                    {{$answer}}
                </td>
                
                <td>
                    <a href="#" class="btn btn-success my-2">Check Answer</a>
                </td>
            </tr>  
        </tbody>
    </table>
</div>
@endsection
