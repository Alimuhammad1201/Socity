@extends('superadmin.layout.master')
@section('page-title')
    Manage Assets
@endsection
@section('main-content')
	<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Assets</h6>
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
                                    <th>Assets Name</th>
                                    <th>Assigend User</th>
                                    <th>Block</th>
                                    <th>Flat</th>
                                    <th>Location</th>
                                    <th>Purchase date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                           <tbody>
                          @forelse ($assets as $row )

                          <tr>
                              <td>{{ $count++ }}</td>
                              <td>{{$row->asset_name}}</td>
                              <td>{{$row->assigned_user}}</td>
                              <td>{{$row->block->Block_name}}</td>
                              <td>{{$row->flatArea->flat_no}}</td>
                              <td>{{$row->location}}</td>
                              <td>{{ Carbon\Carbon::parse($row->purchase_date)->format('d-m-Y')}}</td>
                              <td>{{$row->status}}</td>
                              <td>
                                  <a href="{{route('assets.edit', $row->id)}}" class="edit-btn"
                                      title="Edit">
                                      <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="delete-btn" title="Delete" data-id="{{$row->id}}"
                                    style="margin-left: 20px;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty

                            <tr>
                                <td colspan="8" class="text-center">No records found</td>
                            </tr>
                            @endforelse
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Script --}}




        </div>
    </div>
@endsection
