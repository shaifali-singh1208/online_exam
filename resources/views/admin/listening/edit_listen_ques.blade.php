@extends('admin.main.main')

@section('admin-content')
{{-- <a href="{{ url('edit_para/edit-listening/listening_edit_test/question/') }}" class="btn btn-info m-1">Back</a> --}}
<div>
            <h3 class="text-dark ml-3 text-center">Update Audio Question</h3>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="col-12 grid-margin stretch-card mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('edit-listen-question') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputName1">Question</label>
                                <textarea type="text" class="form-control" id="exampleInputName1" placeholder="questions"
                                    value="" name="question[]">{{ $data->question }}</textarea>
                            </div>
                            <div class="form-group col-6">
                                <label for="time">Time</label>
                                <input type="text" class="form-control" id="time" name="time" value="{{ $data->time }}">
                            </div>
                            <div class="form-group col">
                                <label for="option1">Option 1</label>
                                <input type="text" class="form-control" id="option1" name="options[]" value="{{ json_decode($data['options'])[0] }}">
                            </div>
                            
                            <div class="form-group col">
                                <label for="option2">Option 2</label>
                                <input type="text" class="form-control" id="option2" name="options[]" value="{{ json_decode($data['options'])[1] }}">
                            </div>
                            
                            <div class="form-group col">
                                <label for="option3">Option 3</label>
                                <input type="text" class="form-control" id="option3" name="options[]" value="{{ json_decode($data['options'])[2] }}">
                            </div>
                            
                            <div class="form-group col">
                                <label for="option4">Option 4</label>
                                <input type="text" class="form-control" id="option4" name="options[]" value="{{ json_decode($data['options'])[3] }}">
                            </div>
                            <div class="form-group">
                                <label for="answer">Answer</label>
                                <input type="text" class="form-control" id="answer" name="answer" value="{{ $data->answer }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
