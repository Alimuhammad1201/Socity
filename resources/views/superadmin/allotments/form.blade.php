<div class="row">
    <div class="col-xl-9 mx-auto">

        <div class="card border-top border-white">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-category me-1 font-22 text-white"></i></div>
                    <h5 class="mb-0 text-white">{{_('Add Allotments')}}</h5>
                </div>
                <hr>
                <form id="dynamic-form-container" action="{{ route('allotments.store') }}" method="POST">
                    @csrf
                    <div class="form-container" id="form-template">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="block" class="form-label">Block</label>
                                <select class="form-control" id="block" name="block">
                                    <option value="" selected>Select Block</option>
                                    @foreach($block as $row)
                                       <option value="{{$row->id}}">{{$row->Block_name}}</option>
                                    @endforeach
                                </select>
                                @error('block')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="flat_no" class="form-label">Flat No</label>
                                <select class="form-control" id="flat_no" name="flat_no">
                                    <option value="" selected>Select Flat No</option>
                                </select>
                                @error('flat_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="flat_no" class="form-label">Type</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected>Select Type</option>
                                        <option value="1" >Owner</option>
                                        <option value="2" >Rent</option>

                                    </select>
                                @error('flat_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="ownerName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="ownerName" name="owner_name" placeholder="Owner Name">
                            </div>
                            <div class="col-md-6">
                                <label for="ownerContact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="ownerContact" name="owner_contact" placeholder="Owner Contact Number">
                            </div>
                            <div class="col-md-6">
                                <label for="altOwnerContact" class="form-label">Alternate Contact Number</label>
                                <input type="text" class="form-control" id="altOwnerContact" name="alt_owner_contact" placeholder="Alternate Owner Contact Number">
                            </div>
                            <div class="col-md-6">
                                <label for="ownerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="ownerEmail" name="owner_email" placeholder="Owner Email">
                            </div>

                            <div class="col-md-6">
                                <label for="Nic" class="form-label">Nic No</label>
                                <input type="text" class="form-control" id="Nic" name="owner_nic" placeholder="Owner NIC">
                            </div>
                            <div class="col-md-6">
                                <label for="memberContact" class="form-label">Member Contact</label>
                                <input type="text" class="form-control" id="memberContact" name="member_contact" placeholder="Owner Member Contact">
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>           
                    <div class="mt-4" id="rent-fields-container"></div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-light px-5">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('superadmin.allotments.script')
