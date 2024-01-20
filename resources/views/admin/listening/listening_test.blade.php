@extends('admin.main.main')

@section('admin-content')
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
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="card mt-3">
        <div class="card-tittle " style="background-color:#4B49AC;">
            <h4 class="text-white ml-3">Create Speaking Test </h4>
        </div>
    </div>

    <form id="test3-form" action="{{ url('test3') }}" method="POST" enctype="multipart/form-data" style="display: ;">
        @csrf

        <input type="hidden" name="test_id_witting" value="{{ $test_id[0] }}">
        <input type="hidden" name="test_id_speaking" value="{{ $test_id[1] }}">
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
            <option value="selected">Choose paid test</option>
                        <option value="0"> free</option>
                     <option value="1"> paid</option></select>
            </div>
            <span class="text-danger">@error('paid_type')
                {{ $message }}
            @enderror
            </span>
        </div>
        <button type="submit"  class="mt-4" style="background-color:#4B49AC; color:white; padding:10px;border-radius:5px;">Submit </button>
    </form>







    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
<div class="form-group col-6">
    <label><strong>Audio File</strong></label>
        <input type="file" name="audio[${audioCounter}][audio_quest]" class="form-control" accept="audio/*" placeholder="Upload Audio">
        <span class="input-group-append"></span>
</div>
<div class="form-group col-6">
                        <label><strong>Video File</strong></label>
                            <input type="file" name="audio[${audioCounter}][video_link]" class="form-control" accept="video/*" placeholder="Upload Audio">
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
@endsection
