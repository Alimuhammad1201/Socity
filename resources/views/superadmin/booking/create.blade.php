@extends('superadmin.layout.master')
@section('page-title')
    Add Booking
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
                                <h5 class="mb-0 text-white">Booking Add</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('booking.store') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="community_hall_id" class="form-label">Select Community Hall</label>
                                    <select class="form-control" id="community_hall_id" name="community_hall_id">
                                           <option value="">Nothing To Select</option>
                                       @foreach($communityHall as $row)
                                           <option value="{{$row->id}}">{{$row->hall_name}}</option>
                                       @endforeach
                                    </select>
                                    @error('community_hall_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                    <label for="booking_date" class="form-label">Booking Date</label>
                                    <input type="date" class="form-control" id="booking_date" name="booking_date"
                                           placeholder="Monthly Rent" value="{{ old('booking_date') }}">
                                    @error('booking_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="time" class="form-control" id="start_time" name="start_time"
                                           placeholder="Monthly Rent" value="{{ old('start_time') }}">
                                    @error('start_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="time" class="form-control" id="end_time" name="end_time"
                                           placeholder="Monthly Rent" value="{{ old('end_time') }}">
                                    @error('end_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount"
                                           placeholder="Monthly Rent" value="{{ old('amount') }}">
                                    @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="pending" {{ old('status')=='pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="confirmed" {{ old('status')=='confirmed' ? 'selected' : '' }}>Confirmed
                                        </option>
                                        <option value="cancelled" {{ old('status')=='cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                    @error('status')
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