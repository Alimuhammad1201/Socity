@extends('superadmin.layout.master')
@section('page-title')
    Manage Employees
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Employees</h6>
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
                                <th>Designation</th>
                                <th>Depart</th>
                                <th>Salary</th>
                                <th>Hire Date</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>  
                                    @if($row->designation)
                                   {{ $row->designation->designation}}
                               @else
                                   N/A
                               @endif</td>
                                <td>  
                                     @if($row->depart)
                                    {{ $row->depart->depart_name }}
                                @else
                                    N/A
                                @endif</td>
                                <td>{{$row->salary}}</td>
                                <td>{{$row->hire_date}}</td>
                                <td>{{$row->status}}</td>
                                <td>
                                    <a href="{{route('employees.edit',$row->id)}}" class="edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('employees.delete',$row->id)}}" class="delete-btn" title="Delete" data-id=""
                                       style="margin-left: 20px;">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <a href="{{ route('admin.process_salaries',$row->id) }}" class="btn btn-primary" title="Process Salary" style="margin-left: 20px;">
                                        Monthly Salary Process
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
