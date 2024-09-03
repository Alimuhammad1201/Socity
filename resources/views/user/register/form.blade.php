<div class="row">
    <div class="col-xl-9 mx-auto ">

        <div class="card border-top  border-white">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-category me-1 font-22 text-white"></i>
                    </div>
                    <h5 class="mb-0 text-white">{{ _('Servent & Domestic helper Registeration')}}</h5>
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

                <form class="row g-3" action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  
                   
                    <div class="col-md-4">
                        <label for="block" class="form-label">Block</label>
                        <input type="text" class="form-control" id="block" name="block" placeholder="Block" value="{{$allotments->Block_name}}" readonly>
                       
                        @error('block')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="flat_no" class="form-label">Flat No</label>
                        <input type="text" class="form-control" id="flat_no" name="flat_no" placeholder="Flat No" value="{{$allotments->flat_no}}" readonly>
                       
                        @error('flat_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="owner_name" class="form-label">Owner Name</label>
                        <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Owner Name" value="{{$allotments->OwnerName}}" readonly>
                       
                        @error('owner_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="owner_contact_no" class="form-label">Owner Contact No</label>
                        <input type="text" class="form-control" id="owner_contact_no" name="owner_contact_no" placeholder="Owner Contact No" value="{{$allotments->OwnerContactNumber}}" readonly>
                       
                        @error('owner_contact_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="type" class="form-label">Select Type</label>
                       <select name="type" id="type" class="form-control">
                        <option selected></option>
                        <option>Servent</option>
                        <option>Domeistic Helper </option>
                        <option>Driver </option>


                       </select>
                       
                        @error('type')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                       
                        @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="contact_no" class="form-label">Contact No</label>
                        <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No">
                       
                        @error('contact_no')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                       
                        @error('location')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="nic_no" class="form-label">Cnic No</label>
                        <input type="text" class="form-control" id="nic_no" name="nic_no" placeholder="CNIC NO">
                       
                        @error('nic_no')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="nic_front" class="form-label">CNIC Image Front</label>
                        <input type="file" class="form-control" id="nic_front" onchange="previewImage(event, 'ImagePreview1')" name="nic_front">
                        <img src="" id="ImagePreview1" style="max-width: 80px; margin-top: 10px;">
                       
                        @error('nic_front')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4">
                        <label for="nic_back" class="form-label">CNIC Image Back</label>
                        <input type="file" class="form-control" id="nic_back" onchange="previewImage(event, 'ImagePreview2')" name="nic_back">
                        <img src="" id="ImagePreview2" style="max-width: 80px; margin-top: 10px;">
                       
                        @error('nic_back')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4">
                        <label for="profile" class="form-label">Image</label>
                        <input type="file" class="form-control" id="profile" onchange="previewImage(event, 'ImagePreview3')" name="profile">
                        <img src="" id="ImagePreview3" style="max-width: 80px; margin-top: 10px;">
                       
                        @error('profile')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                 
                    <div class="col-12 mt-5">
                        <button type="submit" class="btn btn-light px-5">Register</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<script>
    function previewImage(event, previewId) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const preview = document.getElementById(previewId);
            preview.src = reader.result;
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>




@include('superadmin.Flat.script')