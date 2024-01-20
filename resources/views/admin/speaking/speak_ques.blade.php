@extends('admin.main.main')

@section('admin-content')
    <style>
        select {
            padding: 10px 0;
            border: 1px solid #ced4da;
        }
    </style>



<div class="container">
    <h4 class="edit-para mb-4" > Update Speaking Question</h4>

    <form action="{{ url('edit-speaking-ques') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">      
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div id="question-container">
            <div class="question">
                <h3>Question 1</h3>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="question1">Question Text</label>
                            <textarea type="text" class="form-control" name="question[]" value="" id="question1">{{$data->question}}</textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="prep_time1">Preparation Time (Minute)</label>
                            <input type="number" class="form-control" name="prep_time[]" value="{{$data->prep_time}}" id="prep_time1">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="prep_time1">Speak Time (Minute)</label>
                            <input type="number" class="form-control" name="time[]" value="{{$data->time}}"id="prep_time1">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="image1_1">Select Image 1</label>
                            <input type="file" name="img1[]" class="form-control" value="{{$data->img1}}" id="image1_1">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="image1_2">Image 2</label>
                            <input type="file" name="img2[]" value="{{$data->img2}}"  class="form-control" id="image1_2">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class ="form-group">
                            <label for="image1_3">Image 3</label>
                            <input type="file" name="img3[]" value="{{$data->img3}}" class="form-control" id="image1_3">
                        </div>
                    </div>
                 
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection