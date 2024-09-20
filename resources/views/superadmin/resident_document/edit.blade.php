@extends('superadmin.layout.master')
@section('page-title')
    Edit Resident Document
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
                                <h5 class="mb-0 text-white">Resident Document Edit</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('resident_document.update',$documents->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$documents->id}}">
                                    <label for="allotment_id" class="form-label">Select Tenant</label>
                                    <select class="form-control" id="allotment_id" name="allotment_id">
                                        <option value="">Nothing To Select</option>
                                        @foreach($allotments as $row)
                                            <option value="{{ $row->id }}"{{$row->id == $documents->allotment_id ? 'selected':''}}>{{ $row->OwnerName }}</option>
                                        @endforeach
                                    </select>
                                    @error('allotment_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="document_type" class="form-label">Document Type</label>
                                    <select class="form-control" id="document_type" name="document_type">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="pending" {{ old('document_type',$documents->document_type)=='pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="confirmed" {{ old('document_type',$documents->document_type)=='confirmed' ? 'selected' : '' }}>Confirmed
                                        </option>
                                        <option value="cancelled" {{ old('document_type',$documents->document_type)=='cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                    @error('document_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="document_path" class="form-label">Document Upload</label>
                                    <input type="file" class="form-control" id="document_path" name="document_path"
                                           placeholder="Monthly Rent" value="{{ old('document_path',$documents->document_path) }}">
                                    @error('document_path')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
@endsection
