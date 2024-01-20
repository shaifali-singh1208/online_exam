@extends('admin.main.main')

@section('admin-content')
@if (\Session::has('success'))
<div  id="success-message" class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@elseif(\Session::has('fail'))
<div   id="success-message" class="alert alert-danger">
    <ul>
        <li>{!! \Session::get('fail') !!}</li>
    </ul>
</div>
@endif

<div class="container">
    <h4 class="text-center">Reset Password</h4>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ url('reset-password') }}">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}} ">

                <div class="form-group">
                    <label for="oldpassword">Old Password</label>
                    <input type="password" class="form-control" id="form4Example3" rows="3" name="old_password" >
                    @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control"  name="new_password" >
                    <span class="text-danger">
                        @error('new_password') {{ $message }}
                        @enderror</span>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_password" >
                    <span class="text-danger">@error('confirm_password') {{ $message }} @enderror</span>
                </div>

                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection