@extends('superadmin.layout.master')
@section('page-title')
    Manage Guest Card
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Guest</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            @php
                                $count = 1;
                            @endphp
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Card No</th>
                                    <th>Block</th>
                                    <th>Flat No</th>
                                    <th>Guest Name</th>
                                    <th>Contact No</th>
                                    <th>Check In Time</th>
                                    <th>Check Out Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guest as $row)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $row->card_no }}</td>
                                <td>{{ $row->block_id }}</td>
                                <td>{{ $row->flat_id }}</td>
                                <td>{{ $row->guest_name }}</td>
                                <td>{{ $row->contact_no }}</td>
                                <td>{{ Carbon\Carbon::parse($row->check_in_time)->format('h:i:s') }}</td>
                                <td>
                                    @if($row->check_out_time == "")
                                       Pending
                                       @else
                                    {{ Carbon\Carbon::parse($row->check_out_time)->format('h:i:s') }}</td>
                                    @endif
                                <td>
                                    <a href="#" class="edit-btn" data-bs-toggle="modal" data-bs-target="#editguestModal"
                                    data-id="{{ $row->id }}" data-name="{{ $row->check_out_time }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Edit Modal HTML --}}
            <div class="modal fade" id="editguestModal" tabindex="-1" aria-labelledby="editguestModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: rgb(0 0 0 / 70%);">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editguestModalLabel">Edit Guest Checkout Time</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-guest-form" method="POST" action="{{ route('guest.update') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="edit-guest-id" name="id">
                                
                                <div class="mb-3">
                                    <label for="edit-check-out-time" class="form-label">Check Out Time</label>
                                    <input type="time" class="form-control" id="edit-check-out-time" name="check_out_time" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.edit-btn').on('click', function () {
            var id = $(this).data('id');
            var checkOutTime = $(this).data('name');
            
            $('#edit-guest-id').val(id);
            $('#edit-check-out-time').val(checkOutTime);
        });
    </script>
@endsection
