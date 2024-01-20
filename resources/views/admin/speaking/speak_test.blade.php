@extends('admin.main.main')

@section('admin-content')
    <style>
        select {
            padding: 10px 0;
            border: 1px solid #ced4da;
        }
    </style>
    
    <div class="container">
        <form action="{{ url('speak') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center" style="color: navy;
            font-size: 50px;">Create Speaking Questions</h1>       
              @if (Session::has('success'))
              <div id="success-message" class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
              </div>
              @endif
              
            <div id="question-container">
                <div class="question">
                    <h3>Question 1</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="question1">Question Text</label>
                                <input type="text" class="form-control" name="question[]" id="question1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prep_time1">Preparation Time (Minute)</label>
                                <input type="number" class="form-control" name="prep_time[]" id="prep_time1">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prep_time1">Speak Time (Minute)</label>
                                <input type="number" class="form-control" name="time[]" id="prep_time1">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="image1_1"> Image 1</label>
                                <input type="file" name="img1[]" class="form-control" id="image1_1">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="image1_2">Image 2</label>
                                <input type="file" name="img2[]" class="form-control" id="image1_2">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class ="form-group">
                                <label for="image1_3">Image 3</label>
                                <input type="file" name="img3[]" class="form-control" id="image1_3">
                            </div>
                        </div>
                        <div class="form-group col-2">
                            <label> <strong>Paid_type</strong></label>
                            <div class="input-group ">
                                <select name="paid_type">
                                    <option selected>Choose paid test</option>
                                    <option value="0"> free</option>
                                    <option value="1"> paid</option>
                                </select>
                             
                            </div>
                            <span class="text-danger">@error('paid_type')
                                {{ $message }}
                            @enderror
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" id="add-question">Add Question</button>
            <button type="button" class="btn btn-danger" id="remove-question">Remove Last Question</button>

            <button type="submit" style="background-color:#4B49AC; color:white; padding:10px;border-radius:5px;">Submit </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let questionCount = 1;
            const questionContainer = $("#question-container");
            const addQuestionButton = $("#add-question");
            const removeQuestionButton = $("#remove-question");

            addQuestionButton.click(function() {
                questionCount++;
                const newQuestion = `
                <div class="question">
                    <h3>Question ${questionCount}</h3>
                    <div class="row">
                        <div class="col-12">

                            <div class="form-group">
                                <label for="question${questionCount}">Question Text</label>
                                <input type="text" class="form-control" name="question[]" id="question${questionCount}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prep_time${questionCount}">Preparation Time (seconds)</label>
                                <input type="number" class="form-control" name="prep_time[]" id="prep_time${questionCount}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="prep_time${questionCount}">Preparation Time (seconds)</label>
                                <input type="number" class="form-control" name="time[]" id="prep_time${questionCount}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="image${questionCount}_1">Select Image 1</label>
                                <input type="file" name="img1[]" class="form-control" id="image${questionCount}_1">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="image${questionCount}_2">Image 2</label>
                                <input type="file" name="img2[]" class="form-control" id="image${questionCount}_2">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="image${questionCount}_3">Image 3</label>
                                <input type="file" name="img3[]" class="form-control" id="image${questionCount}_3">
                            </div>
                        </div>
                    </div>
                </div>
            `;
                questionContainer.append(newQuestion);
            });

            removeQuestionButton.click(function() {
                if (questionCount > 1) {
                    questionContainer.children().last().remove();
                    questionCount--;
                }
            });
        });
    </script>
@endsection
