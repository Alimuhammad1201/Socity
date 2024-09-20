@extends('superadmin.layout.master')
@section('page-title')
    Edit Payment
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
                                <h5 class="mb-0 text-white">Payment Edit</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('payment.update',$payments->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$payments->id}}">
                                <div class="col-md-6">
                                    <label for="allotment_id" class="form-label">Select Tenant</label>
                                      <select class="form-control" id="allotment_id" name="allotment_id">
                                        <option value="">Nothing To Select</option>
                                        @foreach($allotments as $row)
                                            <option value="{{ $row->id }}"{{$row->id == $payments->allotment_id ?'selected':''}}>{{ $row->OwnerName }}</option>
                                        @endforeach
                                     </select>
                                    @error('allotment_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="payment_due" class="form-label">Payment Due</label>
                                    <input type="text" class="form-control" id="payment_due" name="payment_due"
                                           placeholder="Monthly Rent" value="{{ old('payment_due',$payments->payment_due) }}">
                                    @error('payment_due')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="paid" {{ old('status',$payments->status)=='paid' ? 'selected' : '' }}>Paid
                                        </option>
                                        <option value="unpaid" {{ old('status',$payments->status)=='unpaid' ? 'selected' : '' }}>Unpaid
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