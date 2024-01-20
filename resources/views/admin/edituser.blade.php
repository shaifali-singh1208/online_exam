@extends('admin.main.main')

@section('admin-content')
<div class="card">
    <div class="card-tittle " style="background-color:#4B49AC;">
        <h4 class="text-white ml-3">Edit/Update Users Details</h4>
    </div>
</div>
<div class="col-12 grid-margin stretch-card mt-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <p class="card-description">
                
            </p>
            <form action="{{ url('edit_users') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">

                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                        value="{{ $data->name }}" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Textarea</label>
                    <input type="email" class="form-control" id="exampleTextarea1" rows="4"value="{{ $data->email }}" name="email">  
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <div class="input-group col-xs-12">
                        <input type="text" name="number" class="form-control"
                            value="{{ $data->number }} " placeholder=" ">
                        <span class="input-group-append">
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">update</button>
            </form>
        </div>
    </div>
</div>
@endsection
