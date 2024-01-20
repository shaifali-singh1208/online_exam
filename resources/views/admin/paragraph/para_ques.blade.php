@extends('admin.main.main')

@section('admin-content')
    <div class="card">
        <div class="card-title " style="background-color: #4B49AC;">
            <h4 class="text-white ml-3">Update Paragraph Question</h4>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="col-12 grid-margin stretch-card mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('edit-para-question') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="exampleInputName1">Question</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                    value="{{ $data->question }}" name="question[]">
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
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="answer">Answer</label>
                                <input class="form-control" id="answer" name="answer" value="{{ $data->answer }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="time">Time</label>
                                <input type="text" class="form-control" id="time" name="time" value="{{ $data->time }}">
                            </div>
                        </div>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
