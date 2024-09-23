@extends('superadmin.layout.master')
@section('page-title')
    Manage NOC,s
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage NOC,s</h6>
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
                                    <th>Name</th>
                                    <th>Block</th>
                                    <th>Flat</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($noc as $row)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->block->Block_name}}</td>
                                <td>{{$row->flatArea->flat_no}}</td>
                                <td>{!! Str::limit($row->purpose, 20, '...') !!}</td>
                              
                                <td>{{$row->status}}</td>

                                {{-- <td>{{ Carbon\Carbon::parse($row->start_date)->format('d-m-Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($row->end_date)->format('d-m-Y') }}</td>
                                <td>{{$row->approved_by}}</td>
                                <td>{{$row->admin_description}}</td> --}}
                                <td>
                                    <a href="{{route('show.noc', $row->id)}}"><i class="fas fa-eye"></i></a>
                                    

                               
                                        {{-- <a href="{{route('nocs.edit', $row->id)}}"><i class="fas fa-edit"></i></a> --}}

                                        <a href="#" class="delete-btn" title="Delete" data-id="{{ $row->id }}"
                                            style="margin-left: 20px;">
                                            <i class="fas fa-trash"></i>
                                        </a>
                
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
            @include('superadmin.Nocs.script')
        </div>
    </div>
@endsection
