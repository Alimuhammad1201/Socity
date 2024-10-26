@extends('superadmin.layout.master')
@section('page-title')
    Manage Building
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Building</h6>
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
                                <th>Building Name</th>
                                <th>Admin Name</th>
                                <th>Email</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($building_admin as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->building->building_name}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        <a href="{{route('admin-building.edit',$row->id)}}" class="edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{route('admin-building.destroy',$row->id)}}" class="delete-btn" title="Delete" data-id=""
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
