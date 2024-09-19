


<div class="container">
    <h2>Salary Processing for {{ $employee->name }}</h2>

    <div class="row">
        <div class="col-md-6">
            <h4>Employee Details</h4>
            <p><strong>Name:</strong> {{ $employee->name }}</p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Department:</strong> {{ $employee->depart_id }}</p>
            <p><strong>Monthly Salary:</strong> Rs. {{ number_format($monthlySalary, 2) }}</p>
        </div>

        <div class="col-md-6">
            <h4>Salary Details</h4>
            <p><strong>Total Deduction:</strong> Rs. {{ number_format($totalDeduction, 2) }}</p>
            <p><strong>Final Salary:</strong> Rs. {{ number_format($finalSalary, 2) }}</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Attendance Summary for {{ now()->format('F, Y') }}</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Total Hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date }}</td>
                            <td>{{ $attendance->attendance_type }}</td>
                            <td>{{ $attendance->check_in_time }}</td>
                            <td>{{ $attendance->check_out_time }}</td>
                            <td>{{ $attendance->total_hours }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

