@extends('superadmin.layout.master')
@section('page-title')
{{_('Complaint Type')}}
@endsection
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">{{_('Complaint Type')}}</h6>
        <hr>
        <div class="row gap-4">
                   <div class="col-md-8 card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Complaint Types</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @forelse ($type as $row)
                                <tr>
                                    <td>{{ $count++ }}</td>

                                    <td>{{ $row->complaint_type }}</td>
                                    <td>
                                        <a href="#" class="edit-btn" data-bs-toggle="modal" data-bs-target="#editBlockModal"
                                            data-id="{{ $row->id }}" data-name="{{ $row->complaint_type }}" title="Edit">
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
                <div class="modal fade" id="editBlockModal" tabindex="-1" aria-labelledby="editBlockModalLabel" aria-hidden="true" >
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: rgb(0 0 0 / 70%);">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editBlockModalLabel">Edit Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-block-form" method="POST" action="{{ route('complaint_type.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="edit-block-id" name="id">

                                    <div class="mb-3">
                                        <label for="edit-block-name" class="form-label">Type Name</label>
                                        <input type="text" class="form-control" id="edit-block-name" name="complaint_type" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Script --}}

                @include('superadmin.complaint_type.script')

            </div>
        </div>
        <div class="col-md-3 card" style="height: 100%">
            <div class="card-body">
                <form id="dynamic-form-container" action="{{route('complaint_type.store')}}" method="POST">
                    @csrf
                    <div class="form-container" id="form-template">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="type" class="form-label">{{_('Add Complaint Type')}}</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror" id="Type" name="add_type" placeholder="Type">
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Container for dynamic fields -->
                    <div id="rent-fields-container"></div>

                    <!-- Ensure Register button is outside of the form-container -->
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-light px-5" style="width: 100%">Add Type</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    </div>
</div>
@endsection
