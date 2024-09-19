@extends('superadmin.layout.master')
@section('page-title')
    Ganrate Nocs
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
                                <h5 class="mb-0 text-white">Ganrate Noc,s</h5>
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

                            <form class="row g-3" action="{{ route('noc.store') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="noc_number" class="form-label">Noc Number</label>
                                    <input type="text" class="form-control" id="noc_number" name="noc_number" value="{{ session('noc_number') ?? '' }}" readonly>
                                    @error('noc_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="issue_date" class="form-label">Issue Date</label>
                                    <input type="date" class="form-control" id="issue_date" name="issue_date" placeholder="Issue Date" value="{{ old('issue_date') }}">
                                    @error('issue_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="valid_until" class="form-label">Valid Until</label>
                                    <input type="date" class="form-control" id="valid_until" name="valid_until" placeholder="Expiery Date" value="{{ old('valid_until') }}">
                                    @error('valid_until')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="purpose" class="form-label">Purpose</label>
                                    <input type="purpose" class="form-control" id="purpose" name="purpose" placeholder="Purpose" value="{{ old('purpose') }}">
                                    @error('purpose')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="Active" {{ old('status')=='Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Expired" {{ old('status')=='Expired' ? 'selected' : '' }}>Expired</option>
                                        <option value="Cancelled" {{ old('status')=='Cancelled' ? 'selected' : '' }}>Cancelled</option>

                                    </select>
                                    @error('status')
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
    @include('superadmin.Nocs.script');
@endsection