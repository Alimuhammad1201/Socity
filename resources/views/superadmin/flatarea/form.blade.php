<div class="row">
    <div class="col-xl-9 mx-auto ">

        <div class="card border-top  border-white">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-category me-1 font-22 text-white"></i>
                    </div>
                    <h5 class="mb-0 text-white">Flat Area Add</h5>
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

                <form class="row g-3" action="{{ route('flatarea.add') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="flat_no" class="form-label">Flat No</label>
                        <input type="text" class="form-control" id="flat_no" name="flat_no" placeholder="Flat Series"
                            value="{{ old('flat_no') }}">
                        @error('flat_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="block" class="form-label">Block</label>
                        <select class="form-control" id="block" name="block">
                            <option value="" selected>Select Block</option>
                            @foreach($blocks as $row)
                              <option value="{{$row->id}}">{{$row->Block_name}}</option>
                            @endforeach
                        </select>
                        @error('block')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="flat_type" class="form-label">Flat Type</label>
                        <select class="form-control" id="flat_type" name="flat_type">
                            <option value="" selected>Flat Type</option>
                            <option value="2hk" {{ old('flat_type')=='2hk' ? 'selected' : '' }}>2hk</option>
                            <option value="4hk" {{ old('flat_type')=='4hk' ? 'selected' : '' }}>4hk</option>
                            <option value="6hk" {{ old('flat_type')=='6hk' ? 'selected' : '' }}>6hk</option>
                            <option value="8hk" {{ old('flat_type')=='8hk' ? 'selected' : '' }}>8hk</option>
                        </select>
                        @error('flat_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="flat_area" class="form-label">Flat Area</label>
                        <input type="text" class="form-control" id="flat_area" name="flat_area" placeholder="Flat Area"
                            value="{{ old('flat_area') }}">
                        @error('flat_area')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="maintenance_rate" class="form-label">Maintenance Rate /sq feet</label>
                        <input type="text" class="form-control" id="maintenance_rate" name="maintenance_rate"
                            placeholder="Rate per/sq feet" value="{{ old('maintenance_rate') }}">
                        @error('maintenance_rate')
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