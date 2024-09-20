@extends('superadmin.layout.master')
@section('page-title')
{{ _('Edit Assets') }}
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
                            <h5 class="mb-0 text-white">{{ _('Edit Assets')}}</h5>
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

                        <form class="row g-3" action="{{ route('assets.store') }}" method="POST">
                            @csrf



                            <div class="col-md-6">
                                <label for="assets_name" class="form-label">Assets name</label>
                                <input type="text" class="form-control @error('assets_name') is-invalid @enderror" id="assets_name" value="{{$assets->asset_name}}" name="assets_name"
                                    placeholder="Assets Name">

                                @error('assets_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="block" class="form-label">Block</label>
                                <select class="form-select @error('block') is-invalid @enderror" name="block" id="block">
                                    <option value="" selected>Select Block</option>


                                    @foreach ($block as $row )
                                    @php
                                        
                                        $selected = ($row->id == $assets->block_id) ? 'Selected' : '';
                                    @endphp
                                    <option value="{{$row->id}}" {{$selected}}>{{$row->Block_name}}</option>
                                    @endforeach
                                </select>

                                @error('block')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="flat_no" class="form-label">Flat</label>
                                <select class="form-select @error('flat_no') is-invalid @enderror" name="flat_no" id="flat_no">
                                    <option value="" selected>Select Flat No</option>
                                </select>

                                @error('flat_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="col-md-6">
                                <label for="assgiend_user" class="form-label">Assgiend User</label>
                                <input type="text" class="form-control @error('assgiend_user') is-invalid @enderror" id="assgiend_user" name="assgiend_user"
                                    placeholder="Assgiend user">

                                @error('assgiend_user')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location"
                                    placeholder="Location">

                                @error('location')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="purchase_date" class="form-label">Purchase Date</label>
                                <input type="date" class="form-control  @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date"
                                    placeholder="Purchase Date">

                                @error('purchase_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                               <select name="status" id="status" class="form-select  @error('status') is-invalid @enderror">
                                <option value="" selected>Select Status</option>
                                <option value="1">Avaibale</option>
                                <option value="2">Out Of Stock</option>
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

<script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script>
    $(document).ready(function() {
        $('#block').change(function() {
            var blockId = $(this).val();
            if (blockId) {
                $.ajax({
                    url: '/get-flats/' + blockId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#flat_no').empty();
                        $('#flat_no').append('<option value="" selected>Select Flat No</option>');
                        $.each(data, function(Key, value) {
                            $('#flat_no').append('<option value="' + value.id + '">' + value.flat_no + '</option>');
                        });
                    }
                });
            } else {
                $('#flat_no').empty();
                $('#flat_no').append('<option value="" selected>Select Flat No</option>');
            }

        });

        $('#flat_no').change(function() {
            var flatId = $(this).val();
            if (flatId) {
                $.ajax({
                    url: '/get-owner/' + flatId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.ownerName) {
                            $('#assgiend_user').val(data.ownerName);
                            // $('#contact').val(data.contact);
                        } else {
                            $('#assgiend_user').val('');
                            // $('#contact').val('');
                            Swal.fire({
                                icon: 'error',
                                title: 'Owner not found',
                                text: 'No owner found for the selected flat.',
                            });
                        }
                    }
                });
            } else {
                $('#assgiend_user').val('');
                // $('#contact').val('');
            }
        });
    }); 
</script>


@endsection