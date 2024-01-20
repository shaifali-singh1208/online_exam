@extends('admin.main.main')

@section('admin-content')
        <div class=" mb-2" style="background-color:#4B49AC;border-radius: 5px;padding: 5px;text-transform: initial;">
            <h4 class="text-white  text-center mb-2">  View All Test Types Details</h4>
        </div>
  
                <form action="{{ url('edit_test') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                   
               
                </form>
    

    <table class="table table-bordered table-striped m-4" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>S.No</th>
                <th>Test Id</th>
                <th>Test Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           
        
        @foreach ($tests as $data )
            <tr class="table-info">
                <td>{{ $loop->iteration }}</td>
                <td>{{$data->id}}</td>
                @if($data->test_type == 0 )
                    <td>Listening</td>
                    <td>
                        <a href="{{ url('edit_para/edit-listening') }}/{{ $data->id }}" class="btn btn-info my-2">View Listening</a>
                    </td>
                
                @elseif($data->test_type == 1 )
                    <td>Reading</td>
                    <td>
                        <a href="{{ url('edit_para/edit-reading') }}/{{ $data->id }}" class="btn btn-info my-2">View Reading</a>
                    </td>
                
                @elseif($data->test_type == 2 )
                    <td>Writting</td>
                    <td>
                        <a href="{{ url('edit_para/edit-writting') }}/{{ $data->id }}" class="btn btn-info my-2">View Writting</a>
                    </td>
                
                @else
                    <td>Speaking</td>
                    <td>
                        <a href="{{ url('edit_para/edit-speaking') }}/{{ $data->id }}" class="btn btn-info my-2">View Speaking</a>
                    </td>

                @endif
            </tr>
        @endforeach
        
       
                   
        </tbody>
    </table>


<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete employee");
    }
</script>





</div>





@endsection