@extends('admin.main.main')

@section('admin-content')
<h2 class="text-center">Edit Profile</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
    @if (\Session::has('success'))
    <div id="success-message" class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>


@endif

    <form action="{{ url('profile-update') }} "method="post" enctype="multipart/form-user">
        @csrf

        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
            <label for="oldpassword">Name</label>
            <input type="text" class="form-control"  value="{{ $user->name}}" id="form4Example3" rows="3"
                name="name">
            {{-- @error('d')
                <span class="text-danger">{{ $message }}</span>
            @enderror --}}
        </div>

        <div class="form-group">
            <label for="new_password">Email</label>
            <input type="text"  class="form-control" value="{{ $user->email }}" name="email">
            <span class="text-danger">
                {{-- @error('new_password')
                    {{ $message }}
                @enderror --}}
            </span>
        </div>

        <div class="form-group">
            <label for="title">number</label>
            <input type="text" class="form-control" id="form4Example3" style="border: 0.5px solid;"name="number"
                value="{{ $user->number }}" />
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" user-bs-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
@endsection
