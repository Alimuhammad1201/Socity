@extends('superadmin.layout.master')
@section('page-title')
    Add Parking
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
                                <h5 class="mb-0 text-white">Parking Add</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('parking.store') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="allotment_id" class="form-label">Select Tenant</label>
                                    <select class="form-control" id="allotment_id" name="allotment_id">
                                        <option value="">Nothing To Select</option>
                                        @foreach($allotments as $row)
                                            <option value="{{ $row->id }}">{{ $row->OwnerName }}</option>
                                        @endforeach
                                    </select>
                                    @error('allotment_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="parking_space_number" class="form-label">Parking Space Number</label>
                                    <input type="text" class="form-control" id="parking_space_number" name="parking_space_number"
                                           placeholder="Parking Space Number" value="{{ old('parking_space_number') }}">
                                    @error('parking_space_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="vehicle_number" class="form-label">Vehicle Number</label>
                                    <input type="text" class="form-control" id="vehicle_number" name="vehicle_number"
                                           placeholder="Vehicle Number" value="{{ old('vehicle_number') }}">
                                    @error('vehicle_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="parking_status" class="form-label">Parking Status</label>
                                    <select class="form-control" id="parking_status" name="parking_status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="pending" {{ old('parking_status')=='pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="confirmed" {{ old('parking_status')=='confirmed' ? 'selected' : '' }}>Confirmed
                                        </option>
                                        <option value="cancelled" {{ old('parking_status')=='cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                    @error('parking_status')
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
