@extends('superadmin.layout.master')
@section('page-title')
    Edit Rent Flat
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
                                <h5 class="mb-0 text-white">Edit Rent Flat</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{route('superadminrents.update',$userrents->id)}}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <input type="hidden" value="{{$userrents->id}}">
                                    <label for="block" class="form-label">Block</label>
                                    <select class="form-control" id="block" name="block">
                                        <option value="" selected>Select Block</option>
                                        @foreach($block as $row)
                                            <option value="{{$row->id}}"{{$row->id == $userrents->block->id ? 'selected' : ''}}>{{$row->Block_name}}</option>
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
                                        @foreach($flats as $flat)
                                            <option value="{{$flat->id}}" {{$flat->id == $userrents->flat_no ? 'selected' : ''}}>{{$flat->flat_no}}</option>
                                        @endforeach
                                    </select>
                                    @error('flat_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Owner Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Owner Name" value="{{$userrents->allotment ? $userrents->allotment->name : ''}}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact" class="form-label">Owner Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="contact"
                                           placeholder="Owner Contact Number" value="{{$userrents->allotment ? $userrents->allotment->name : ''}}"  readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="renty_name" class="form-label">Renty Name</label>
                                    <input type="text" class="form-control" id="renty_name" name="renty_name"
                                           placeholder="Renty Name" value="{{$userrents->renty_name}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="renty_contact" class="form-label">Renty Contact Number</label>
                                    <input type="text" class="form-control" id="renty_contact" name="renty_contact"
                                           placeholder=" Renty Contact" value="{{$userrents->renty_contact}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="request" class="form-label">Request</label>
                                    <input type="textarea" class="form-control" id="request" name="request"
                                           placeholder="request" value="{{$userrents->request}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="admin_request" class="form-label">admin Request</label>
                                    <input type="textarea" class="form-control" id="admin_request" name="admin_request"
                                           placeholder="admin request" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected>Select Status</option>
                                        <option value="pending">pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nic_front" class="form-label">Nic Front Img</label>
                                    <input type="file" class="form-control" id="nic_front" name="nic_front"
                                           value="{{$userrents->nic_front}}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nic_back" class="form-label">Nic Back Img</label>
                                    <input type="file" class="form-control" id="nic_back" name="nic_back"
                                           value="{{$userrents->nic_back}}">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#block').change(function () {
                var blockId = $(this).val();
                if (blockId) {
                    $.ajax({
                        url: '/get-flats/' + blockId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#flat_no').empty();
                            $('#flat_no').append('<option value="" selected>Select Flat No</option>');
                            $.each(data, function (key, value) {
                                $('#flat_no').append('<option value="' + value.id + '">' + value.flat_no + '</option>');
                            });
                        }
                    });
                } else {
                    $('#flat_no').empty();
                    $('#flat_no').append('<option value="" selected>Select Flat No</option>');
                }
            });

            $('#flat_no').change(function () {
                var flatId = $(this).val();
                if (flatId) {
                    $.ajax({
                        url: '/get-owner/' + flatId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data.ownerName) {
                                $('#name').val(data.ownerName);
                                $('#contact').val(data.contact);
                            } else {
                                $('#name').val('');
                                $('#contact').val('');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Owner not found',
                                    text: 'No owner found for the selected flat.',
                                });
                            }
                        }
                    });
                } else {
                    $('#name').val('');
                    $('#contact').val('');
                }
            });
        });

    </script>
@endsection

