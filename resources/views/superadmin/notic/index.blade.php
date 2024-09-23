@extends('superadmin.layout.master')
@section('page-title')
    Notice
@endsection
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <form class="row g-3" action="{{ route('notic.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-11">
                        <label for="message" class="form-label">Message</label>

                        <div class="input-group mb-3">

                            <input type="text" class="form-control" id="message" name="message" placeholder="Message">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <label for="image"><i class=" bx bx-photo-album"></i></label>
                                <input type="file" id="image" name="image" class="" style="display: none;">
                            </span>
                            </div>
                        </div>

                        @error('message')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-1">
                        <button type="submit" class="btn btn-light" style="margin-top: 30px;">Submit</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    @php
                        $count = 1;
                    @endphp
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Tital</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($notic as $row )
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{$row->title}}</td>
                            <td style="width:15%;">
                                <!-- Small Image -->
                                <a href="{{ asset('uploads/notice/' . $row->image) }}" target="_blank">
                                    <img src="{{ asset('uploads/notice/' . $row->image) }}" alt="Notice Image"
                                         class="img-thumbnail" style="width: 120px; height: 180px; cursor: pointer;">
                                </a>
                            </td>
                            <td>
                                <a href="#" class="edit-btn" data-bs-toggle="modal" data-bs-target="#editComplaintModal"
                                   data-id="{{ $row->id }}" data-title="{{ $row->title }}"
                                   data-image="{{ asset('uploads/notice/' . $row->image) }}" title="Edit">
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
                            <td colspan="4" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @include('superadmin.notic.edit_modal')
    @include('superadmin.notic.script')

@endsection
