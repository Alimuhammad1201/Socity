@extends('user.layout.master')
@section('page-title')
   Notice
@endsection
@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
      
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                @php
                    $count = 1;
                @endphp
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Tital</th>
                        <th>Image</th>
                    </tr>
                </thead>
               <tbody>
                @forelse ($notic as $row )
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{$row->title}}</td>
                    <td style="width:15%;">
                        <!-- Small Image -->
                        <a href="{{ asset('uploads/notice/' . $row->image) }}" target="_blank">
                            <img src="{{ asset('uploads/notice/' . $row->image) }}" alt="Notice Image" class="img-thumbnail" style="width: 150px; height: 110px; cursor: pointer;">
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No records found</td>
                </tr>
                @endforelse
               </tbody>
            </table>
        </div>
    </div>
</div>    
@endsection