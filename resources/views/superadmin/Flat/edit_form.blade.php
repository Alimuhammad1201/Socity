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

                <form class="row g-3" action="{{ route('flat.update', $flat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                
                    <div class="col-md-6">
                        <label for="flat_no" class="form-label">Flat No</label>
                        <input type="text" class="form-control" id="flat_no" name="flat_no" placeholder="Flat Series" 
                            value="{{ $flat->flat_no }}">
                        @error('flat_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="block" class="form-label">Block</label>
                        <select class="form-control" id="block" name="block">
                            <option value="" disabled>Select Block</option>
                            @foreach ($block as $row)
                                @php
                                $selected = ($flat->block_id == $row->id) ? 'selected' : '';
                                @endphp
                                <option value="{{ $row->id }}" {{ $selected }}>{{ $row->Block_name }}</option>
                            @endforeach
                        </select>
                        @error('block')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  
                    
                    <div class="col-12">
                        <label for="floor" class="form-label">Floor</label>
                        <input type="text" class="form-control" id="floor" name="floor"
                            placeholder="Rate per/sq feet" value="{{ $flat->floor }}">
                        @error('floor')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-light px-5">Save changes</button>
                    </div>
                </form>
                

            </div>
        </div>

    </div>
</div>