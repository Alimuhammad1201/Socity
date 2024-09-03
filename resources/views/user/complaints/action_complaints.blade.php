@extends('user.layout.master')
@section('page-title')
Action Complaints
@endsection
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->

        <!--end breadcrumb-->
        
        <h6 class="mb-0 text-uppercase">Action Complaints</h6>
        <hr>
        <div class="container ">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Block</th>
                            <th>Flat</th>
                            <th>Admin Remark</th>
                            <th>Status</th>
                            <th>Resolved Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp

                     
                            @foreach ($action as $row )
                                
                            <tr>
                                <td>{{$count ++}}</td>
                                <td>{{$row->block}}</td>
                                <td>{{$row->flat_no}}</td>
                                <td>{{$row->admin_remarks}}</td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->updated_at}}</td>
                                
                                
                                
                            </tr>
                          
                        @endforeach
                       
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
@include('superadmin.complaints.edit_modal')
@include('superadmin.complaints.script')

@endsection
