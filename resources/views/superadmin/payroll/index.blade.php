@extends('superadmin.layout.master')
@section('page-title')
    Manage Payroll
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Payroll</h6>
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
                                <th>Employees</th>
                                <th>Salary Amount</th>
                                <th>Deducation</th>
                                <th>Net Salary</th>
                                <th>Pay Date</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payrolls as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->employee->name}}</td>
                                <td>{{$row->salary_amount}}</td>
                                <td>{{$row->deducation}}</td>
                                <td>{{$row->net_salary}}</td>
                                <td>{{$row->pay_date}}</td>
                                <td>
                                    <a href="{{route('payroll.edit',$row->id)}}" class="edit-btn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('payroll.delete',$row->id)}}" class="delete-btn" title="Delete" data-id=""
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
