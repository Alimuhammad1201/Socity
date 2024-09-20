@extends('superadmin.layout.master')
@section('page-title')
    Manage Booking
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Booking</h6>
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
                                <th>Hall Name</th>
                                <th>Allotment Name</th>
                                <th>Booking Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->communityHall->hall_name}}</td>
                                <td>{{$row->allotment->OwnerName}}</td>
                                <td>{{$row->booking_date}}</td>
                                <td>{{$row->amount}}</td>
                                <td>{{$row->status}}</td>
                                <td>
                                    <a href="{{route('booking.edit',$row->id)}}" class="edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('booking.destroy',$row->id)}}" class="delete-btn" title="Delete" data-id=""
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
