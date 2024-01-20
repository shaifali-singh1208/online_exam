
@extends('admin.main.main')

@section('admin-content')
@if (Session::has('success'))
<div id="success-message" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
    <style>
        select {
            padding: 10px 0;
            border: 1px solid #ced4da;
        }
    </style>
        <h1 class="text-center">Create All Test </h1>
        <div class="panel-body">
            <div id="test1-form">
                <form action="{{ url('test1') }}" method="post" enctype="multipart/form-data" class="test-form">
                    @csrf
                    <div class="form-group mt-5">
                        <h1 class="">Add writting Test 1 </h1>
                        <div class="container">

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
                                    <input type="number" class="form-control" id="exampleInputName1" placeholder=""
                                        name="time[]">
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
                                    <input type="number" class="form-control" id="exampleInputName1" placeholder=""
                                        name="time[]">
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
                                <span class="text-danger">@error('paid_type')
                                    {{ $message }}
                                @enderror
                                </span>
                    </div>
                    <button type="submit" class="" style="background-color:#4B49AC; color:white; padding:10px;border-radius:5px;">Submit </button>
                </form>
            </div>
            </div>
        </div>
            @endsection