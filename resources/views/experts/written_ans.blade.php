@extends('experts.main.main')

@section('experts-content')

@if (Session::has('success'))
<div id="success-message" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

@if (session('info'))
<div class="alert alert-info">
    {{ session('info') }}
</div>
@endif 


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
                    {{ $question_id }}
                </td>
                <td>
                    {{ $answer }}
                </td>
                <td>
                   
 {{-- <a href="{{url('/update-result')}}/{{$celpip_id}}/{{$test_id}}/{{$written_id}}"    class="btn btn-success my-2"> result-update</button> --}}

    <a href="{{ url('/written_ques/written_answer/ques_answer/update-result', ['celpip' => $celpip->id, 'test_id' => $test_id, 'write_id' => $written_id]) }}" data-toggle="modal" data-target="#updateResultModal" class="btn btn-success my-2">result-update</a>

                </td>
            </tr>
        </tbody>
    </table>
    </div>




 <div class="modal fade" id="updateResultModal" tabindex="-1" role="dialog" aria-labelledby="updateResultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateResultModalLabel">Update Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('update_written_ans') }}">
                        @csrf
                        <input type='hidden' name='celpip_test_id' value="{{ $celpip->id }}">

                        <input type="hidden" name="test_id" value="{{ $test_id }}">

                        <input type="hidden" name="writing_ans_id" value="{{ $written_id}}">

                        <!-- Add your form fields here -->
                        <div class="form-group">
                            <label for="w_brands">W Brands:</label>
                            <input type="text" class="form-control" name="w_bands" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Result</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
