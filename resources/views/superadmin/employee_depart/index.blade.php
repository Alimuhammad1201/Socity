@extends('superadmin.layout.master')
@section('page-title')
{{_('Manage Depart')}}
@endsection
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">{{_('Manage Depart')}}</h6>
        <hr>
        <div class="row gap-4">
            <div class="col-md-8 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Depart Name</th>
                                    <th>action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                $count = 1;
                                @endphp
                                @forelse ($depart as $row)
                                <tr>
                                    <td>{{ $count++ }}</td>

                                    <td>{{ $row->depart_name }}</td>
                                    <td>
                                        <a href="#" class="edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editDepartModal" data-id="{{ $row->id }}"
                                            data-name="{{ $row->depart_name }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="delete-btn" title="Delete" data-id="{{ $row->id }}"
                                            style="margin-left: 20px;">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Edit Modal HTML Structure -->
                    <div class="modal fade" id="editDepartModal" tabindex="-1" aria-labelledby="editDepartModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="background-color: rgb(0 0 0 / 70%);">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editDepartModalLabel">Edit Depart</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-depart-form" method="POST" action="{{ route('employee_depart.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="edit-depart-id" name="id">

                                        <div class="mb-3">
                                            <label for="edit-depart-name" class="form-label">Depart Name</label>
                                            <input type="text" class="form-control" id="edit-depart-name"
                                                name="depart_name" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Script --}}

                    @include('superadmin.employee_depart.script')

                </div>
            </div>
            <div class="col-md-3 card" style="height: 100%">
                <div class="card-body">
                    <form id="dynamic-form-container" action="{{route('employee_depart.store')}}" method="POST">
                        @csrf
                        <div class="form-container" id="form-template">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="depart_name" class="form-label">{{_('Add Depart')}}</label>
                                    <input type="text" class="form-control @error('depart_name') is-invalid @enderror"
                                        id="depart_name" name="depart_name" placeholder="Depart Name">
                                    @error('depart_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Container for dynamic fields -->
                        <div id="rent-fields-container"></div>

                        <!-- Ensure Register button is outside of the form-container -->
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-light px-5" style="width: 100%">Add Depart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
</div>
@endsection