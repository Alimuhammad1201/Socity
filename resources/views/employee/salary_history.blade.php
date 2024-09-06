<!-- resources/views/employee/salary_history.blade.php -->


    <h3>Salary History</h3>

    <h3>Admin Dashboard</h3>

    <a href="{{ route('admin.process_salaries') }}" class="btn btn-primary">Process Monthly Salaries</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Month</th>
                <th>Final Salary</th>
                <th>Processed Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaryHistory as $history)
                <tr>
                    <td>{{ $history->month }}</td>
                    <td>{{ $history->final_salary }}</td>
                    <td>{{ $history->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
