@extends('user.layout.master')
@section('page-title')
    Add Rent Flat
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
                                <h5 class="mb-0 text-white">Add Rent Flat</h5>
                            </div>
                            <hr>
                            <form class="row g-3" action="{{route('rents.store')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
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
                                    <label for="name" class="form-label">Owner Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Owner Name" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact" class="form-label">Owner Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="contact"
                                           placeholder="Owner Contact Number" readonly>
                                </div>
                                <div>
                                    <label for="renty_name" class="form-label">Renty Name</label>
                                    <input type="text" class="form-control" id="renty_name" name="renty_name"
                                           placeholder="Renty Name">
                                </div>
                                <div>
                                    <label for="renty_contact" class="form-label">Renty Contact Number</label>
                                    <input type="text" class="form-control" id="renty_contact" name="renty_contact"
                                           placeholder="Renty Contact">
                                </div>
                                <div>
                                    <label for="request" class="form-label">Request</label>
                                    <input type="textarea" class="form-control" id="request" name="request"
                                           placeholder="request">
                                </div>
                                <div class="mb-3">
                                    <label for="nic_front" class="form-label">Nic Front Img</label>
                                    <input type="file" class="form-control" id="nic_front" name="nic_front">
                                </div>
                                <div class="mb-3">
                                    <label for="nic_back" class="form-label">Nic Back Img</label>
                                    <input type="file" class="form-control" id="nic_back" name="nic_back">
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
        });

        $('#block').change(function () {
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
    </script>
@endsection

