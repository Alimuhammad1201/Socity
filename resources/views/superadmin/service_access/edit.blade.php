@extends('superadmin.layout.master')
@section('page-title')
    Edit Service Access
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
                                <h5 class="mb-0 text-white">Service Access Edit</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('service_access.update',$services->id) }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$services->id}}">
                                    <label for="allotment_id" class="form-label">Select Tenant</label>
                                    <select class="form-control" id="allotment_id" name="allotment_id">
                                        <option value="">Nothing To Select</option>
                                        @foreach($allotments as $row)
                                            <option value="{{ $row->id }}"{{$row->id == $services->allotment_id ?'selected':''}}>{{ $row->OwnerName }}</option>
                                        @endforeach
                                    </select>
                                    @error('allotment_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="service_name" class="form-label">Service Name</label>
                                    <input type="text" class="form-control" id="service_name" name="service_name"
                                           placeholder="Service Name" value="{{ old('service_name',$services->service_name) }}">
                                    @error('service_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="access_status" class="form-label">Access Status</label>
                                    <select class="form-control" id="access_status" name="access_status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="pending" {{ old('access_status',$services->access_status)=='pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="confirmed" {{ old('access_status',$services->access_status)=='confirmed' ? 'selected' : '' }}>Confirmed
                                        </option>
                                        <option value="cancelled" {{ old('access_status',$services->access_status)=='cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                    @error('access_status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="reason" class="form-label">Reason</label>
                                    <input type="textarea" class="form-control" id="reason" name="reason"
                                           placeholder="Reason" value="{{ old('reason',$services->reason) }}">
                                    @error('reason')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-light px-5">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
