@extends('superadmin.layout.master')
@section('page-title')
    Edit Car Stickers
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
                                <h5 class="mb-0 text-white">Car Stickers Edit</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('carsticker.update',$carsticker->id) }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$carsticker->id}}">
                                    <label for="allotment_id" class="form-label">Select Tenant</label>
                                    <select class="form-control" id="allotment_id" name="allotment_id">
                                        <option value="">Nothing To Select</option>
                                        @foreach($allotments as $row)
                                            <option value="{{ $row->id }}"{{$row->id == $carsticker->allotment_id ?'selected':''}}>{{ $row->OwnerName }}</option>
                                        @endforeach
                                    </select>
                                    @error('allotment_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="car_number" class="form-label">Car Number</label>
                                    <input type="text" class="form-control" id="car_number" name="car_number"
                                           placeholder="Service Name" value="{{ old('car_number',$carsticker->car_number) }}">
                                    @error('car_number')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="sticker_id" class="form-label">Sticker ID</label>
                                    <input type="text" class="form-control" id="sticker_id" name="sticker_id"
                                           placeholder="Service Name" value="{{ old('sticker_id',$carsticker->sticker_id) }}">
                                    @error('sticker_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="issue_date" class="form-label">Issue Date</label>
                                    <input type="date" class="form-control" id="issue_date" name="issue_date"
                                           placeholder="Service Name" value="{{ old('issue_date',$carsticker->issue_date) }}">
                                    @error('issue_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                                           placeholder="Service Name" value="{{ old('expiry_date',$carsticker->expiry_date) }}">
                                    @error('expiry_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="charges" class="form-label">Charges</label>
                                    <input type="text" class="form-control" id="charges" name="charges"
                                           placeholder="Service Name" value="{{ old('charges',$carsticker->charges) }}">
                                    @error('charges')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="Active" {{ old('status',$carsticker->status)=='Active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option
                                            value="Duplicate" {{ old('status',$carsticker->status)=='Duplicate' ? 'selected' : '' }}>
                                            Duplicate
                                        </option>
                                        <option value="Inactive" {{ old('status',$carsticker->status)=='Inactive' ? 'selected' : '' }}>
                                            Inactive
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
