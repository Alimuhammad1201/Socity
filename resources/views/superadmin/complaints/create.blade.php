@extends('user.layout.master')
@section('page-title')
{{ _('Add Complaints') }}
@endsection
@section('main-content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-9 mx-auto ">

                <div class="card border-top  border-white">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bx-category me-1 font-22 text-white"></i>
                            </div>
                            <h5 class="mb-0 text-white">{{ _('Create Complaint')}}</h5>
                        </div>
                        <hr>

                        <!-- Display Validation Errors -->
                        {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif --}}

                        <!-- Display Success Message -->


                        <form class="row g-3" action="{{route('complaints.store')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="block" class="form-label">Block</label>
                                <select class="form-control" id="block" name="block">
                                    <option value="" selected>Select Block</option>
                                    @foreach($block as $row)
                                       <option value="{{$row->id}}">{{$row->Block_name}}</option>
                                    @endforeach
                                </select>
                                @error('block')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="flat_no" class="form-label">Flat No</label>
                                <select class="form-control" id="flat_no" name="flat_no">
                                    <option value="" selected>Select Flat No</option>
                                </select>
                                @error('flat_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label">Owner Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Owner Name" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Owner Contact Number</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Owner Contact Number" readonly>
                            </div>


                            <div class="col-md-12">
                                <label for="complaint_type" class="form-label">Complaint Type</label>
                                <select class="form-control" id="complaint_type" name="complaint_type">
                                    <option value="" selected>Select Complaint Type</option>
                                    @foreach ($type as $row)
                                    <option value="{{$row->id}}">{{$row->complaint_type}}</option>
                                    @endforeach
                                </select>
                                @error('complaint_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div>
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="description">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-light px-5">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

        @include('superadmin.complaints.script');
    </div>
</div>
<!--end page wrapper -->
@endsection
