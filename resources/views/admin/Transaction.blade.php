@extends('admin.main.main')

@section('admin-content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif 

    @php
        $totalEarnings = 0; // Initialize total earnings variable
    @endphp

        <div class="card-title p-1" style="background-color:#4B49AC;">
            <h4 class="text-white m-2">Transactions Details <span class="text-white float-right">Total Earnings: Rs.{{ number_format($totalEarnings, 2) }}</span></h4>
        </div>
        <!-- The rest of your card content goes here -->
    
    <table class="table table-bordered  table-striped m-4" id="myTable">
        <thead>
            <tr class="table-danger">
                <th>S.No.</th>
                <th>Order_ID</th>
                <th>Amount</th>
                <th>Sub_Date</th>
                <th>Subsciption_Expire</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($transactions as $emp)
                <tr class="table-info">
                    <td>{{ $i++ }}</td>
                    <td>{{ ucwords($emp->order_id) }}</td>
                    <td>{{ $emp->amount }}</td>
                    <td>{{ $emp->subscription_start }}</td>
                    <td>{{ $emp->subscription_expiry }}</td>
                    <td>{{ $emp->transaction_status }}</td>
                </tr>
                @php
                    $totalEarnings += $emp->amount; // Accumulate total earnings
                @endphp
            @endforeach
        </tbody>
    </table>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete employee");
        }
    </script>

    <script>
        // Update total earnings in the card title
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.card-title span').textContent = 'Total Earnings: ${{ number_format($totalEarnings, 2) }}';
        });
    </script>
</div>

@endsection
