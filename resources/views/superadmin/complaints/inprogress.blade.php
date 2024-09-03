@extends('superadmin.layout.master')
@section('page-title')
In Progress
@endsection
@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->

        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">InProgress Complain</h6>
        <hr>
        <div class="container ">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Block Number</th>
                            <th>Flat Number</th>
                            <th>Complaint Type</th>
                            <th>Complaint Description</th>
                            <th>Raised Date</th>
                            <th>Admin Remark</th>
                            <th>Status</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1
                        @endphp
                        @forelse ($in_progress as $row)
                            
                        
                        <tr>
                            <td>{{$count++}}</td>
                            <td>{{$row->Block_name}}</td>
                            <td>{{$row->flat_no}}</td>
                            <td>{{$row->complaint_type}}</td>
                            <td>{{$row->description}}</td>
                            <td>{{ Carbon\Carbon::parse($row->created_at)->format('d m Y')}}</td>
                            <td>{{$row->admin_remarks}}</td>
                            <td>{{$row->status}}</td>
                           
                        </tr>
                        @empty
                        <tr class="mt-5">
                            <td colspan="11" style="text-align: center">No Record Found</td>
                        </tr>
                            
                        @endforelse 
                        
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Include Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</div>
@endsection
