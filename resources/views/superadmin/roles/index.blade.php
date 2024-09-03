@extends('superadmin.layout.master')
@section('page-title')
    Manage Roles
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Roles</h6>
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
                                <th>Role Name</th>
                                <th>Permissions</th>

                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->role_name}}</td>
                                    <td>
                                        @if(is_array($row->permissions))
                                            @foreach($row->permissions as $id => $name)
                                                <p>{{ $name }}</p>
                                            @endforeach
                                        @else
                                            {{ $row->permissions }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('role.edit',$row->id)}}" class="edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{route('role.destroy',$row->id)}}" class="delete-btn" title="Delete"
                                           data-id=""
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
