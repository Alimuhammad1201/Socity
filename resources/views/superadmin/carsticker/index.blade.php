@extends('superadmin.layout.master')
@section('page-title')
    Manage Car Sticker
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Car Sticker</h6>
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
                                <th>Car Number </th>
                                <th>Sticker ID</th>
                                <th>Issue Date</th>
                                <th>Expiry Date</th>
                                <th>Chareges</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carstickers as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->allotment ? $row->allotment->OwnerName : '--' }}</td>
                                    <td>{{$row->car_number}}</td>
                                    <td>{{$row->sticker_id}}</td>
                                    <td>{{$row->issue_date}}</td>
                                    <td>{{$row->expiry_date}}</td>
                                    <td>{{$row->charges}}</td>
                                    <td>{{$row->status}}</td>
                                    <td>
                                        <a href="{{ route('car.sticker.pdf', $row->id) }}" class="delete-btn" title="Delete" data-id="" style="">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="{{route('carsticker.edit',$row->id)}}" class="edit-btn"
                                           style="margin-left: 20px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{route('carsticker.destroy',$row->id)}}" class="delete-btn" title="Delete" data-id=""
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
