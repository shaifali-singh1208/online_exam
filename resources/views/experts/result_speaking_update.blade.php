<!-- update_written_ans.blade.php -->
@extends('experts.main.main')

@section('experts-content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="post" action="{{ url('update_speaking_ans') }}">
                        @csrf
                        <input type="hidden" name="test_id" value="{{ $tests->first()->id }}">
                        <input type="hidden" name="speaking_ans_id" value="{{ $speak_id }}">
                        <input type='hidden' name='celpip_test_id' value="{{ $celpip->id }}">
                        <!-- Add your form fields here -->
                        <div class="form-group">
                            <label for="w_brands">S Brands:</label>
                            <input type="text" class="form-control" name="s_bands" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Result</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
