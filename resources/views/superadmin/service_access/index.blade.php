@extends('superadmin.layout.master')
@section('page-title')
    Manage Service Access
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Service Access</h6>
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
                                <th>Resident Name</th>
                                <th>Service Name</th>
                                <th>Access Status</th>
                                <th>Reason</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->allotment->OwnerName}}</td>
                                    <td>{{$row->service_name}}</td>
                                    <td>{{$row->access_status}}</td>
                                    <td>{{$row->reason}}</td>
                                    <td>
                                        <a href="{{route('service_access.edit',$row->id)}}" class="edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{route('service_access.destroy',$row->id)}}" class="delete-btn" title="Delete" data-id=""
                                           style="margin-left: 20px;">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
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
