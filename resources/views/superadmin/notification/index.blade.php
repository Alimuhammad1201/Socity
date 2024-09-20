@extends('superadmin.layout.master')
@section('page-title')
    Manage Notification
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Notification</h6>
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
                                <th>Allotment Name</th>
                                <th>Message</th>
                                <th>Sent At</th>
                                <th>Sent Via</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notifications as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->allotment->OwnerName}}</td>
                                <td>{{$row->message}}</td>
                                <td>{{$row->sent_at}}</td>
                                <td>{{$row->sent_via}}</td>
                                <td>{{$row->status}}</td>
{{--                                    <td>--}}
{{--                                        <a href="{{route('payment.edit',$row->id)}}" class="edit-btn">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{route('payment.destroy',$row->id)}}" class="delete-btn" title="Delete" data-id=""--}}
{{--                                           style="margin-left: 20px;">--}}
{{--                                            <i class="fas fa-trash"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
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
