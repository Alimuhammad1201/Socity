@extends('employee.layout.master')
@section('page-title')
    Manage Leave
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Leave</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            @php
                                $count = 1;
                            @endphp
                            <thead>
                              
                                    
                                <tr>
                                    <th>S.No</th>
                                    <th>leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Approved By</th>
                                    <th>Description By Admin</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($action_leave as $row)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$row->leave_type}}</td>
                                <td>{{ Carbon\Carbon::parse($row->start_date)->format('d-m-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($row->end_date)->format('d-m-Y') }}</td>
                                <td>{{$row->approved_by}}</td>
                                <td>{{$row->admin_description}}</td>
                                <td>{{$row->status}}</td>
                               
                            </tr>
                            @endforeach

                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML Structure -->
            {{-- Script --}}
            {{--@include('superadmin.flatarea.script')--}}
        </div>
    </div>
@endsection
