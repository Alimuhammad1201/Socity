@extends('superadmin.layout.master')
@section('page-title')
    Add Activity Logs
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
                                <h5 class="mb-0 text-white">Activity Logs Add</h5>
                            </div>
                            <hr>

                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('activity_logs.update',$activities->id) }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$activities->id}}">
                                <div class="col-md-6">
                                    <label for="activity_type" class="form-label">Notification Type</label>
                                    <select class="form-control" id="activity_type" name="activity_type">
                                        <option value="" selected>Nothing Selected</option>
                                        <option value="hire" {{ old('activity_type',$activities->activity_type)=='hire' ? 'selected' : '' }}>Hire</option>
                                        <option value="fire" {{ old('activity_type',$activities->activity_type)=='fire' ? 'selected' : '' }}>Fire</option>
                                        <option value="update" {{ old('activity_type',$activities->activity_type)=='update' ? 'selected' : '' }}>Update</option>
                                    </select>
                                    @error('activity_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="employee_id" class="form-label">Employees</label>
                                    <select class="form-control" id="employee_id" name="employee_id">
                                           <option value="">Nothing To Select</option>
                                       @foreach($employees as $row)
                                           <option value="{{$row->id}}"{{$row->id == $activities->employee_id ?'selected':''}}>{{$row->name}}</option>
                                       @endforeach
                                    </select>
                                    @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                           placeholder="Date"
                                           value="{{ old('date',$activities->date) }}">
                                    @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="description" class="form-label">description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           placeholder="Message"
                                           value="{{ old('description',$activities->description) }}">
                                    @error('description')
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