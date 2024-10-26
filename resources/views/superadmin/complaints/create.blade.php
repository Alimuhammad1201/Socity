@extends('user.layout.master')
@section('page-title')
    Add Complaints
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
                                <h5 class="mb-0 text-white">Create Complaint</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{route('complaints.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="block" class="form-label">Block</label>
                                    <select class="form-control" id="block" name="block">
                                        <option value="" selected>Select Block</option>
                                        @if($block)
                                            <option value="{{ $block->id }}">{{ $block->Block_name }}</option>
                                        @else
                                            <option value="" disabled>No Blocks Available</option>
                                        @endif
                                    </select>
                                    @error('block')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="flat_no" class="form-label">Flat No</label>
                                    <select class="form-control" id="flat_no" name="flat_no">
                                        <option value="" selected>Select Flat No</option>
                                        @if($flats && $flats->count() > 0)
                                            @foreach($flats as $flat)
                                                <option value="{{ $flat->flat_id }}">{{ $flat->flat_no }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>No Flats Available</option>
                                        @endif
                                    </select>
                                    @error('flat_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Owner Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Owner Name" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact" class="form-label">Owner Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="contact"
                                           placeholder="Owner Contact Number" readonly>
                                </div>


                                <div class="col-md-12">
                                    <label for="complaint_type" class="form-label">Complaint Type</label>
                                    <select class="form-control" id="complaint_type" name="complaint_type">
                                        <option value="" selected>Select Complaint Type</option>
                                        @foreach ($complaint_type as $row)
                                            <option value="{{$row->id}}">{{$row->complaint_type}}</option>
                                        @endforeach
                                    </select>
                                    @error('complaint_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           placeholder="description">
                                </div>
                                <div class="mb-3">
                                    <label for="before_img" class="form-label">Before Image</label>
                                    <input type="file" class="form-control" id="before_img" name="before_img">
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
