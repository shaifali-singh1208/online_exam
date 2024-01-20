@extends('admin.main.main')

@section('admin-content')
@if (Session::has('success'))
<div id="success-message" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
    @endif

    <style>
        .add-audio-button {
            margin-right: 10px;
            float: left;
        }

        .remove-audio-button {
            margin: 10px;
            float: right;
        }

        .button-row {
            clear: both;
            margin-top: 20px;
        }

        .button-container {
            display: flex;
        }

        select {
            padding: 10px 0;
            border: 1px solid #ced4da;

        }
    </style>

    <h1 class="text-center"> Create All Test </h1>
    <div class="panel-body">
        <div id="test1-form">
            <form action="{{ url('test1') }}" method="post" enctype="multipart/form-data" class="test-form">
                @csrf
                {{-- <h1 class="">Add writting Test 1 </h1> --}}

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputName1">Questions No.1 </label>
                            <input type="text" class="form-control" id="exampleInputName1"
                                placeholder="Enter Questions Here" name="question[]">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputName1">Set Time</label>
                            <input type="number" class="form-control" id="exampleInputName1" placeholder="" name="time[]">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">

                            <label for="exampleInputName1">Questions No.2</label>
                            <input type="text" class="form-control" id="exampleInputName1"
                                placeholder="Enter Questions Here" name="question[]">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputName1">Set Time</label>
                            <input type="number" class="form-control" id="exampleInputName1" placeholder="" name="time[]">
                        </div>
                    </div>

                    <div class="form-group col-2">
                        <label> <strong>Paid_type</strong></label>
                        <div class="input-group ">
                            <select name="paid_type">
                                <option value="selected">Choose paid test</option>
                                <option value="0"> free</option>
                                <option value="1"> paid</option>
                            </select>
                        </div>
                        <span class="text-danger">  @error('paid_type'){{ $message }} @enderror </span>
                    </div>

                </div>
    
               <button type="submit" style="background-color:#4B49AC; color:white; padding:10px;border-radius:5px;">Submit Test 1</button>
    </form>
    </div>
    </div>
</div>
    {{-- </div> --}}
    <!-- Test 2 Form -->
    {{-- <form id="test2-form" action="{{ url('test2') }}" method="POST" enctype="multipart/form-data" class="test1-form"
                    style="display: none;">
                    @csrf
                    <h2>Speaking Test</h2>
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
                                        <label for="image1_1">Select Image 1</label>
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" id="add-question">Add Question</button>
                    <button type="button" class="btn btn-danger" id="remove-question">Remove Last Question</button>

                    <button type="submit" class="btn btn-primary mt-4">Submit Test 2</button>
                </form>
                <!-- Test 3 Form -->
                <form id="test3-form" action="{{ url('test3') }}" method="POST" enctype="multipart/form-data"
                    style="display: none;">
                    @csrf


                    <!-- Add Audio button -->
                    <div class="button-row">
                        <button type="button" id="add_audio" class="btn btn-info add-audio-button">Add Audio</button>
                    </div>

                    <!-- Audio and Questions container -->
                    <div id="audios-container">
                        <!-- Audio and Questions sections will be dynamically added here -->
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
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit Test 3</button>
                </form>

                <!-- Test 4 Form -->
                <form id="test4-form" action="{{ url('test4') }}" method="POST" enctype="multipart/form-data"
                    style="display: none;">
                    @csrf

                        <div class="button-row">
                            <!-- Add Paragraph button -->
                            <button type="button" id="add_paragraph" class="btn btn-info add-paragraph-button">Add
                                Paragraph</button>
                        </div>

                        <!-- Paragraphs and Questions container -->
                        <div id="paragraphs-container">
                            <!-- Paragraph and Questions sections will be dynamically added here -->
                        </div>
                        <div class="form-group col-2">
                            <label> <strong>Paid_type</strong></label>
                            <div class="input-group ">
                                <select name="paid_type">
                                    <option value="selected">Choose paid test</option>
                                    <option value="0"> free</option>
                                    <option value="1"> paid</option>
                                </select>
                            </div>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary mt-4">Submit Test 4</button>
                    </form> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentTest = 1;

            function showNextTestForm() {
                // Hide the current form
                $(`#test${currentTest}-form`).hide();

                // Increment the current test
                currentTest++;

                // Show the next form
                $(`#test${currentTest}-form`).show();
            }

            // Attach a submit event to each form
            $(".test-form").submit(function() {
                // This will allow the form to submit normally
                showNextTestForm();
            });

            $(".test2-form").submit(function() {
                // This will allow the form to submit normally
                showNextTestForm();
            });
        });
    </script>


    {{-- <script>
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


                    <script>
                        $(document).ready(function() {
                            let audioCounter = 0;

                            function addQuestion(audioIndex) {
                                const questionRows = $(`#tab_logic_${audioIndex} tbody tr`);
                                const questionCounter = questionRows.length + 1;

                                const newQuestion = ` 
                <tr class="question-row">
                    <td>
                    <div class="form-group">
                        <label for="question_${audioIndex}_${questionCounter}_text">Question ${questionCounter}</label>
                        <input type="text" class="form-control" name="audio[${audioIndex}][questions][${questionCounter}][text]" >
                 </div>
                        </td>
                    <td>
                    <div class="form-group">
                        <label for="question_${audioIndex}_${questionCounter}_audio">Audio for Question ${questionCounter}</label>
                        <input type="file"  class="form-control" name="audio[${audioIndex}][questions][${questionCounter}][que_audio]" accept="audio/*">
                   </div>
                        </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" name="audio[${audioIndex}][questions][${questionCounter}][options][1]" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" name="audio[${audioIndex}][questions][${questionCounter}][options][2]" >
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="form-control" name="audio[${audioIndex}][questions][${questionCounter}][options][3]">
                        </div>
                    </td>
                    <td>
                        <div class "form-group">
                            <input type="text" class="form-control" name="audio[${audioIndex}][questions][${questionCounter}][options][4]">
                        </div>
                    </td>
                    <td>
                        <select name="audio[${audioIndex}][questions][${questionCounter}][answer]">
                            <option value="selected">Choose Right Answer</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            <option value="4">Option 4</option>
                        </select>
                    </td>
                </tr>
            `;

                                $(`#tab_logic_${audioIndex} tbody`).append(newQuestion);
                            }

                            function addAudio() {
                                audioCounter++;
                                const newAudio = `
            <div class="audio" id="audio_number${audioCounter}">
                <button type="button" class="btn btn-info remove-audio">Remove Audio</button>
                <div class="row">
                <div class="form-group col-12">
                    <label><strong>Audio File</strong></label>
                        <input type="file" name="audio[${audioCounter}][audio_quest]" class="form-control" accept="audio/*" placeholder="Upload Audio">
                        <span class="input-group-append"></span>
                </div>
                <div class="form-group col-6">
                    <label><strong>Set time:</strong></label>
                        <input type="number" name="audio[${audioCounter}][time]" class="form-control">
                        <span class="input-group-append"></span>
                    </div>
                  



        </div>


                <button type="button" class="btn btn-info add-question">Add Question</button>
                <!-- Questions and Answers Table -->
                <table class="table question-table" id="tab_logic_${audioCounter}">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Audio</th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th>Correct Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="question-row">
                            <td>
                            <div class="form-group">

                                <label for="question_${audioCounter}_1_text">Question 1</label>
                                <input type="text"  class="form-control"name="audio[${audioCounter}][questions][1][text]">
                           </div>
                                </td>
                            <td>
                            <div class="form-group">
                                <label for="question_${audioCounter}_1_audio"></label>
                                <input type="file" class="form-control" name="audio[${audioCounter}][questions][1][que_audio]" accept="audio/*">
                          </div>
                                </td>
                            <td>
                                <div class="form-group">
                                <label></label>

                                    <input type="text" class="form-control" name="audio[${audioCounter}][questions][1][options][1]">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <label></label>

                                    <input type="text" class="form-control" name="audio[${audioCounter}][questions][1][options][2]">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <label></label>

                                    <input type="text" class="form-control" name="audio[${audioCounter}][questions][1][options][3]">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                <label></label>

                                    <input type="text" class="form-control" name="audio[${audioCounter}][questions][1][options][4]">
                                </div>
                            </td>
                            <td>
                            <label></label>

                                <select name="audio[${audioCounter}][questions][1][answer]">
                                    <option value="selected">Choose Right Answer</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            `;

                                $("#audios-container").append(newAudio);

                                // Attach a click event to the "Add Question" button within this audio
                                $(`#audio_number${audioCounter} .add-question`).click(function() {
                                    addQuestion(audioCounter);
                                });
                            }

                            addAudio();

                            $("#add_audio").click(addAudio);

                            $(document).on("click", ".remove-audio", function() {
                                $(this).closest(".audio").remove();
                            });
                        });
                    </script>

                    <script>
                        $(document).ready(function() {
                            let paragraphCounter = 0;

                            function addQuestion(paragraphIndex) {
                                const questionRows = $(`#tab_logic_${paragraphIndex} tbody tr`);
                                const questionCounter = questionRows.length + 1;

                                const newQuestion = `
        <tr class="question-row">
            <td>                    <div class="form-group">

                <label for="question_${paragraphIndex}_${questionCounter}_text">Question ${questionCounter}</label>
                <input type="text"  class="form-control" name="paragraphs[${paragraphIndex}][questions][${questionCounter}][text]" ></div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo" name="paragraphs[${paragraphIndex}][questions][${questionCounter}][options][1]" >
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo" name="paragraphs[${paragraphIndex}][questions][${questionCounter}][options][2]" >
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo" name="paragraphs[${paragraphIndex}][questions][${questionCounter}][options][3]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo" name="paragraphs[${paragraphIndex}][questions][${questionCounter}][options][4]">
                </div>
            </td>
            <td>
                <select name="paragraphs[${paragraphIndex}][questions][${questionCounter}][answer] ">
                    <option value="selected">Choose Right Answer</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </td>
        </tr>
        `;

                                $(`#tab_logic_${paragraphIndex} tbody`).append(newQuestion);
                            }



                            function addParagraph() {
                                paragraphCounter++;
                                const newParagraph = `
<div class="paragraph" id="paragraph_number${paragraphCounter}">
<button type="button" class="btn btn-info remove-paragraph">Remove Paragraph</button>
<div class="form-group">
    <label for="paragraph_${paragraphCounter}">Paragraph ${paragraphCounter}</label>
    <textarea class="form-control" rows="4" name="paragraphs[${paragraphCounter}][text]"></textarea>
</div>
<div class="row">
<div class="form-group col-5">
    <label><strong>File upload</strong></label>
    <div class="input-group ">
        <input type="file" name="paragraphs[${paragraphCounter}][para_img]" class="form-control file-upload-info"
            accept="image/*" placeholder="Upload Question Image">
        <span class="input-group-append"></span>
    </div>
</div>
<div class="form-group col-5">
    <label> <strong>Set Time here</strong></label>
    <div class="input-group">
        <input type="number" name="time[]" class="form-control file-upload-info" placeholder=""">
               <span class=" input-group-append"></span>
    </div>
</div>

</div>
<button type="button" class="btn btn-info add-question mt-3">Add Question</button>

<!-- Questions and Answers Table -->
<table class="table question-table" id="tab_logic_${paragraphCounter}">
    <thead>
        <tr>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Correct Answer</th>
        </tr>
    </thead>
    <tbody>
        <tr class="question-row">
            <td>
                <div class="form-group">

                    <label for="question_${paragraphCounter}_1_text">Question 1</label>
                    <input type="text" class="form-control"
                        name="paragraphs[${paragraphCounter}][questions][1][text]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo"
                        name="paragraphs[${paragraphCounter}][questions][1][options][1]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo"
                        name="paragraphs[${paragraphCounter}][questions][1][options][2]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo"
                        name="paragraphs[${paragraphCounter}][questions][1][options][3]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control demo"
                        name="paragraphs[${paragraphCounter}][questions][1][options][4]">
                </div>
            </td>
            <td>
                <select name="paragraphs[${paragraphCounter}][questions][1][answer]">
                    <option value="selected">Choose Right Answer</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </td>
        </tr>
    </tbody>
</table>
</div>
`;

                                $("#paragraphs-container").append(newParagraph);

                                // Attach a click event to the "Add Question" button within this paragraph
                                $(`#paragraph_number${paragraphCounter} .add-question`).click(function() {
                                    addQuestion(paragraphCounter);
                                });
                            }


                            addParagraph();

                            $("#add_paragraph").click(addParagraph);

                            $(document).on("click", ".remove-paragraph", function() {
                                $(this).closest(".paragraph").remove();
                            });
                        });
                    </script>







 --}}







@endsection
