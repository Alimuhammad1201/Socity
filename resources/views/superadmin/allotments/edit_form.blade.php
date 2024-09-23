<div class="row">
    <div class="col-xl-9 mx-auto">

        <div class="card border-top border-white">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-category me-1 font-22 text-white"></i></div>
                    <h5 class="mb-0 text-white">Edit Allotments</h5>
                </div>
                <hr>
                <form id="dynamic-form-container" action="{{ route('allotments.update', $allot->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-container" id="form-template">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="block" class="form-label">Block</label>
                                <select class="form-control" id="block" name="block">
                                    <option value="" selected>Select Block</option>
                                    @foreach($block as $row)
                                     @php
                                        $selected = ($allot->block_id == $row->id) ? 'selected' : '';
                                     @endphp
                                       <option value="{{$row->id}}" {{ $selected }}>{{$row->Block_name}}</option>
                                    @endforeach
                                </select>
                                @error('block')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="flat_no" class="form-label">Flat No</label>
                                <select class="form-control" id="flat" name="flat">
                                    <option value="" selected>Select Flat No</option>
                                    @foreach ($flat as $row )
                                    @php
                                        $selected = ($allot->flat_id == $row->id) ? ' selected' : '';
                                    @endphp

                                    <option value="{{$row->id}}"{{ $selected }}>{{$row->flat_no}}</option>
                                    @endforeach

                                </select>
                                @error('flat')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="flat_no" class="form-label">Type</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" {{ $allot->status == '' ? 'selected' : ''}}>Select Type</option>
                                        <option value="1" {{ $allot->status == '1' ? 'selected' : ''}} >Owner</option>
                                        <option value="2" {{ $allot->status == '2' ? 'selected' : ''}} >Rent</option>

                                    </select>
                                @error('flat_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="ownerName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="ownerName" name="owner_name" placeholder="Owner Name" value="{{$allot->OwnerName}}">
                            </div>
                            <div class="col-md-6">
                                <label for="ownerContact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="ownerContact" name="owner_contact" placeholder="Owner Contact Number" value="{{$allot->OwnerContactNumber}}">
                            </div>
                            <div class="col-md-6">
                                <label for="altOwnerContact" class="form-label">Alternate Contact Number</label>
                                <input type="text" class="form-control" id="altOwnerContact" name="alt_owner_contact" placeholder="Alternate Owner Contact Number" value="{{$allot->OwnerAlternateContactNumber}}">
                            </div>
                            <div class="col-md-6">
                                <label for="ownerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="ownerEmail" name="owner_email" placeholder="Owner Email" value="{{$allot->OwnerEmail}}">
                            </div>

                            <div class="col-md-6">
                                <label for="Nic" class="form-label">Nic No</label>
                                <input type="text" class="form-control" id="Nic" name="owner_nic" placeholder="Owner NIC" value="{{$allot->nic}}">
                            </div>
                            <div class="col-md-6">
                                <label for="memberContact" class="form-label">Member Contact</label>
                                <input type="text" class="form-control" id="memberContact" name="member_contact" placeholder="Owner Member Contact" value="{{$allot->OwnerMemberCount}}">
                            </div>


                        </div>
                    </div>
                    <div class="mt-4" id="rent-fields-container"></div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-light px-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('superadmin.allotments.script')
