@extends('admin.main.main')

@section('admin-content')
    @if (Session::has('success'))
        <div id="success-message" class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @elseif(Session::has('fail'))
        <div id="success-message" class="alert alert-danger " role="alert">
            {{ Session::get('fail') }}
        </div>
    @endif

    <h2 class="text-center"> My Profile</h2>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ url('update-profile') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }} ">

                    <div class="form-group">
                        <label for="oldpassword">Name</label>
                        <input type="text" class="form-control" disabled value="{{ $user->name }} "id="form4Example3"
                            rows="3" name="name">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">Email</label>
                        <input type="text" disabled class="form-control" value="{{ $user->email }} " name="email">
                        <span class="text-danger">
                            @error('new_password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Number</label>
                        <input type="text" disabled class="form-control" value="{{ $user->number }} " name="number">
                        <span class="text-danger">
                            @error('confirm_password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                      <div class="demo d-flex" >
                    <h6><a href="{{ url('change-profile/update-profile/') }}/ {{ $user->id }}" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" class="btn btn-info ml-3">Edit Profile</a> </h6>
                            <h6><a href="{{url('reset-password')}}/{{ $user->id }}" class="btn btn-info ml-3 ">Reset Password</a> </h6>
                    </div>
                        </form>
            </div>
        </div>
    </div>


    {{-- <h3 class="ml-5 mt-1"> {{ $user->name }}</h3>
    <div class="d-flex">
        <h6><a href="/profile/ {{ $user->id }}" user-bs-toggle="modal" user-bs-target="#exampleModal "
                class="btn btn-info ml-3">Edit Profile</a> </h6>
        <h6><a href="{{ url('reset_pass') }}/{{ $user->id }}" class="btn btn-info ml-3 ">Reset Password</a> </h6>
    </div>
    </div> --}}


    <!-- Button trigger modal -->



    <!-- Modal -->


    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds (adjust as needed)
    </script>


    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('profile-update') }} "method="post" enctype="multipart/form-user">
                        @csrf
                        @if (\Session::has('success'))
                            <div id="success-message" class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif

                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="oldpassword">Name</label>
                            <input type="text" class="form-control" value="{{ $user->name }} "id="form4Example3"
                                rows="3" name="name">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }} " name="email">
                            <span class="text-danger">
                                @error('new_password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="title">number</label>
                            <input type="text" class="form-control" id="form4Example3"
                                style="border: 0.5px solid;"name="number" value="{{ $user->number }}" />
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>

                            <button type="button" class="btn btn-secondary" user-bs-dismiss="modal">Close</button>
                        </div>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
@endsection
