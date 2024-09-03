@extends('superadmin.layout.master')
@section('page-title')
All Complaints
@endsection
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->

        <!--end breadcrumb-->
        
        <h6 class="mb-0 text-uppercase">All Complaints</h6>
        <hr>
        <div class="container ">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Block</th>
                            <th>Flat</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Raised Date</th>
                            <th>Admin Remark</th>
                            <th>Status</th>
                            <th>Resolved Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp

                        @foreach ($complaints as $row )
                            
                        <tr>
                            <td>{{$count ++}}</td>
                            <td>{{$row->Block_name}}</td>
                            <td>{{$row->flat_no}}</td>
                            <td>{{$row->complaint_type}}</td>
                            <td>{{ \Illuminate\Support\Str::limit($row->description, 10, '...') }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d - m - Y')}}</td>
                            <td>{{$row->admin_remarks}}</td>
                            <td>{{$row->status}}</td>
                            <td>0000-00-00</td>
         
                            <td>
                                {{-- <button type="button" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> 
                                </button> --}}
                                <a href="#" class="edit-btn" data-bs-toggle="modal" data-bs-target="#editComplaintModal"
                                data-id="{{ $row->id }}" data-status="{{ $row->status }}" data-admin_remark="{{ $row->admin_remarks }}" title="Edit">
                                <i class="fas fa-edit"></i>
                               
                             </a>
                            </td>
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
