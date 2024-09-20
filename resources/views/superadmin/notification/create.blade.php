@extends('superadmin.layout.master')
@section('page-title')
    Add Notification
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
                                <h5 class="mb-0 text-white">Notification Add</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('notification.store') }}" method="POST">
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
                                    <label for="sent_at" class="form-label">Sent At:</label>
                                    <input type="datetime-local" class="form-control" id="sent_at" name="sent_at" placeholder="Sent At" value="{{ old('sent_at') }}">
                                    @error('sent_at')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="sent_via" class="form-label">Sent Via</label>
                                    <select class="form-control" id="sent_via" name="sent_via">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="SMS" {{ old('sent_via')=='SMS' ? 'selected' : '' }}>SMS</option>
                                        <option value="WhatsApp" {{ old('sent_via')=='WhatsApp' ? 'selected' : '' }}>WhatsApp</option>
                                        <option value="Email" {{ old('sent_via')=='Email' ? 'selected' : '' }}>Email</option>
                                    </select>
                                    @error('sent_via')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea type="text" class="form-control" id="message" name="message"
                                              placeholder="Message" value="{{ old('message') }}"></textarea>
                                    @error('message')
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