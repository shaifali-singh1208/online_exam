@extends('admin.main.main')

@section('admin-content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif 
    

    <style>
        .add-paragraph-button {
            margin-right: 10px;
            float: left;
        }

        .remove-paragraph-button {
            margin: 10px;
            float: right;
        }

        .button-row {
            clear: both;
            margin-top: 20px;
        }

        .button-container {
            display: flex;

            /*justify-content: space-between;*/
        }

        input.form-control.demo {
            margin-top: 27px;
        }

        select {
            padding: 10px 0;
            border: 1px solid #ced4da;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Create Paragraph Question</h1>
            <div class="panel-body">
                <form id="test4-form" action="{{ url('test4') }}" method="POST" enctype="multipart/form-data"
                style="display: ;"> 
                 @csrf
                {{-- @foreach ($data as $item)
                {{ $item }}
            @endforeach --}}
            <input type="hidden" name="test_id_witting" value="{{ $test_id[0] }}">
            <input type="hidden" name="test_id_speaking" value="{{ $test_id[1] }}">
            <input type="hidden" name="test_id_listening" value="{{ $test_id[2] }}">
                    <!-- Add Paragraph button -->
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
                                <option selected>Choose paid test</option>
                                <option value="0"> free</option>
                                <option value="1"> paid</option>
                            </select>
                            <span class="text-danger">@error('paid_type')
                                {{ $message }}
                            @enderror
                            </span>                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="mt-4" style="background-color:#4B49AC; color:white; padding:10px;border-radius:5px;">Submit </button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <option selected>Choose Right Answer</option>
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
                        <option selected> Choose Right Answer</option>
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
@endsection
