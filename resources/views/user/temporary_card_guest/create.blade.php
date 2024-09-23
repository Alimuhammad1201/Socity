@extends('user.layout.master')
@section('page-title')
    Register Your Guest
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
                                <h5 class="mb-0 text-white">Register</h5>
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
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('guest.store') }}" method="POST">
                                @csrf

                                <div class="col-md-6">
                                    <label for="card_no" class="form-label">Card No</label>
                                    <input type="text" class="form-control" id="card_no" name="card_no" placeholder="card_no" value="{{ session('card_no') }}" readonly>
                                    @error('card_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="block_id" class="form-label">Block</label>
                                    <input type="text" class="form-control" id="block_id" name="block_id" placeholder="block_id" value="{{ $user->block->Block_name }}">
                                    @error('block_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label for="flat_id" class="form-label">Flat No</label>
                                    <input type="text" class="form-control" id="flat_id" name="flat_id" placeholder="flat_id" value="{{ $user->flatArea->flat_no }}">
                                    @error('flat_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="guest_name" class="form-label">Guest Name</label>
                                    <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="guest_name" value="{{ old('guest_name') }}">
                                    @error('guest_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="contact_no" class="form-label">Contact No</label>
                                    <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="contact_no" value="{{ old('contact_no') }}">
                                    @error('contact_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                             

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="check_in" class="form-label">Check In Time</label>
                                    <input type="time" class="form-control" id="check_in" name="check_in" placeholder="Check In Time" value="{{ old('check_in') }}">
                                    @error('check_in')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                              
                                <div class="col-12">
                                    <button type="submit" class="btn btn-light px-5">Register</button>
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