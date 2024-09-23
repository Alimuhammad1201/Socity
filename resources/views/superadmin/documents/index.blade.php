@extends('superadmin.layout.master')
@section('page-title')
    Manage Document
@endsection
@section('main-content')


    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Document</h6>
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
                                    <th>Document Name</th>
                                    <th>Document Type</th>
                                    <th>Document</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($documents as $docs )
                                  
                              <tr>
                                  <td>{{$count++}}</td>
                                  <td>{{$docs->document_name}}</td>
                                  <td>{{$docs->document_type}}</td>
                                  <td>
                                    
                                        <a href="{{ asset('uploads/documents/' . $docs->file_path) }}" target="_blank">
                                            <img src="{{ asset('/assets/images/pdf.jpg') }}" alt="PDF Icon" width="50px" />
                                        </a>
                                    
                                </td>
                                  <td>{{$docs->uploaded_by}}</td> 
                                  <td>
                                    <a href="{{route('document.edit', $docs->id)}}" class="edit-btn"
                                        title="Edit">
                                       <i class="fas fa-edit"></i>
                                   </a>
                                   <a href="#" class="delete-btn" title="Delete" data-id="{{ $docs->id }}"
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
    
            @include('superadmin.documents.script')
        </div>
    </div>


@endsection