@extends('superadmin.layout.master')
@section('page-title')
    Manage Tenancy Agreement
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Tenancy Agreement</h6>
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
                                <th>Name</th>
                                <th>Monthly Rent</th>
                                <th>Agreement Start Date</th>
                                <th>Agreement End Date</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tenants as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->allotment->OwnerName}}</td>
                                <td>{{$row->monthly_rent}}</td>
                                <td>{{$row->agreement_start}}</td>
                                <td>{{$row->agreement_end}}</td>
                                <td>{{$row->payment_status}}</td>
                                <td>
                                    <a href="{{route('tenancy.edit',$row->id)}}" class="edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('tenancy.destroy',$row->id)}}" class="delete-btn" title="Delete" data-id=""
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
