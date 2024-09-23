@extends('superadmin.layout.master')
@section('page-title')
@endsection
@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-9 mx-auto ">
        
                <div class="card border-top  border-white">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bx-category me-1 font-22 text-white"></i>
                            </div>
                            <h5 class="mb-0 text-white">{{ _('Flat Area Add')}}</h5>
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
        
                        <form class="row g-3" action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                           
                           
                            <div class="col-md-12">
                                <label for="document_name" class="form-label">Document Name</label>
                                <input type="text" class="form-control" id="document_name" name="document_name" placeholder="Document Name">
                               
                                @error('document_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="document_type" class="form-label">Document Type</label>
                                <input type="text" class="form-control" id="document_type" name="document_type" placeholder="Document Type">
                               
                                @error('document_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="file_path" class="form-label">Select Document</label>
                                <input type="file" class="form-control" id="file_path" name="file_path" placeholder="file_path">
                               
                                @error('file_path')
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
        
        @include('superadmin.Flat.script');
    </div>
</div>
@endsection