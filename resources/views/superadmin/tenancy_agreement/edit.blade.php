@extends('superadmin.layout.master')
@section('page-title')
    Edit Tenancy Agreement
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
                                <h5 class="mb-0 text-white">Tenancy Agreement Edit</h5>
                            </div>
                            <hr>

                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('tenancy.update', $tenants->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="allotment_id" class="form-label">Tenants</label>
                                    <select class="form-control" id="allotment_id" name="allotment_id">
                                        <option selected>Select Designation</option>
                                        @foreach($allotments as $row)
                                             <option value="{{$row->id}}"{{$row->id == $tenants->allotment_id ? 'selected': ''}}>{{$row->OwnerName}}</option>
                                        @endforeach
                                    </select>
                                    @error('allotment_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="agreement_start" class="form-label">Agreement Start</label>
                                    <input type="date" class="form-control" id="agreement_start" name="agreement_start"
                                           placeholder="Agreement Start"
                                           value="{{ old('agreement_start',$tenants) }}">
                                    @error('agreement_start')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="agreement_end" class="form-label">Agreement End</label>
                                    <input type="date" class="form-control" id="agreement_end" name="agreement_end"
                                           placeholder="Agreement End"
                                           value="{{ old('agreement_end',$tenants) }}">
                                    @error('agreement_end')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="monthly_rent" class="form-label">Monthly Rent</label>
                                    <input type="text" class="form-control" id="monthly_rent" name="monthly_rent"
                                           placeholder="Monthly Rent" value="{{ old('monthly_rent',$tenants) }}">
                                    @error('monthly_rent')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_status" class="form-label">Payment Status</label>
                                    <select class="form-control" id="payment_status" name="payment_status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="Paid" {{ old('payment_status',$tenants->payment_status)=='Paid' ? 'selected' : '' }}>Paid
                                        </option>
                                        <option value="Unpaid" {{ old('payment_status',$tenants->payment_status)=='Unpaid' ? 'selected' : '' }}>
                                            Unpaid
                                        </option>
                                    </select>
                                    @error('payment_status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="agreement_pdf" class="form-label">Agreement PDF</label>
                                    <input type="file" class="form-control" id="agreement_pdf" name="agreement_pdf"
                                           placeholder="Agreement PDF" accept="application/pdf" value="{{ old('agreement_pdf',$tenants->agreement_pdf) }}">
                                    @error('agreement_pdf')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-light px-5">Update</button>
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