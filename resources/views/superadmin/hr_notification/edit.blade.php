@extends('superadmin.layout.master')
@section('page-title')
    Edit Hr Notification
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
                                <h5 class="mb-0 text-white">Hr Notification Edit</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('hr_notification.update',$notifications->id) }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$notifications->id}}">
                                <div class="col-md-6">
                                    <label for="notification_type" class="form-label">Notification Type</label>
                                    <select class="form-control" id="notification_type" name="notification_type">
                                        <option value="" selected>Nothing Selected</option>
                                        <option value="salary_alert" {{ old('notification_type', $notifications->notification_type)=='salary_alert' ? 'selected' : '' }}>
                                            Salary Alert
                                        </option>
                                        <option value="hr_notification" {{ old('notification_type',$notifications->notification_type)=='hr_notification' ? 'selected' : '' }}>
                                            Hr Notification
                                        </option>
                                    </select>
                                    @error('notification_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected>Nothing Selected</option>
                                        <option value="sent" {{ old('status',$notifications->status)=='sent' ? 'selected' : '' }}>Sent</option>
                                        <option value="pending" {{ old('status',$notifications->status)=='pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                           placeholder="Date"
                                           value="{{ old('date',$notifications->date) }}">
                                    @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="message" class="form-label">Message</label>
                                    <input type="text" class="form-control" id="message" name="message"
                                           placeholder="Message"
                                           value="{{ old('message',$notifications->message) }}">
                                    @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--                                <div class="col-12">--}}
                                {{--                                    <label for="pay_slip" class="form-label">pay Slip</label>--}}
                                {{--                                    <input type="file" class="form-control" id="pay_slip"--}}
                                {{--                                           name="pay_slip"--}}
                                {{--                                           placeholder="Rate per/sq feet" value="{{ old('pay_slip') }}">--}}
                                {{--                                    @error('pay_slip')--}}
                                {{--                                    <div class="text-danger">{{ $message }}</div>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
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