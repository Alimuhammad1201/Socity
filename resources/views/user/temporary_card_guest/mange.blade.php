@extends('user.layout.master')
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
                                <td>{{$count++}}</td>
                                <td>{{$row->card_no}}</td>
                                <td>{{$row->guest_name}}</td>
                                <td>{{$row->contact_no}}</td>
                                <td>{{ Carbon\Carbon::parse($row->check_in_time)->format('h:i:s') }}</td>
                                <td>
                                    @if($row->check_out_time == "")
                                      Pending

                                    @else
                                    {{ Carbon\Carbon::parse($row->check_out_time)->format('h:i:s')}}</td>
                                    @endif
                                <td>
                                    <a href="{{route('user.guest.edit', $row->id)}}"><i class="fas fa-edit"></i></a>
                                </td>
                            
                             
                               
                            </tr>
                            @endforeach

                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML Structure -->
            {{-- Script --}}
            {{--@include('superadmin.flatarea.script')--}}
        </div>
    </div>
@endsection
