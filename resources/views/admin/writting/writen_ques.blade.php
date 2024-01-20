@extends('admin.main.main')

@section('admin-content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <div class="card">
        <div class="card-title" style="background-color:#4B49AC;">
            <h4 class="text-white ml-3"> Update Written Questions</h4>
        </div>
    </div>
                <h4 class="card-title"></h4>
                <form action="{{ url('edit-writting-ques') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group mt-5">
                        <h1 class="">Update writting Questions </h1>

                        <div class="row">

                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label for="exampleInputName1">Questions No.1 </label>
                                    <textarea type="text" class="form-control" id="exampleInputName1"
                                        placeholder="Enter Questions Here" name="question[]" value=>{{$data->question}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label for="exampleInputName1">Set Time</label>
                                    <input type="number" class="form-control" id="exampleInputName1" placeholder=""
                                        name="time[]" value={{$data->time}}>
                                </div>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="mt-4" style="background-color:#4B49AC; color:white; padding:10px;border-radius:5px;">Submit </button>

                </form>

   
@endsection
