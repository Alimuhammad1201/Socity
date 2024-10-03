@extends('superadmin.layout.master')
@section('page-title')
    Edit Package
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
                                <h5 class="mb-0 text-white">Package Edit</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('packages.update',$packages->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$packages->id}}">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Name" value="{{ old('name',$packages->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                           placeholder="Price" value="{{ old('price',$packages->price) }}">
                                    @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="duration" class="form-label">Duration</label>
                                    <input type="text" class="form-control" id="duration" name="duration"
                                           placeholder="Price" value="{{ old('duration',$packages->duration) }}">
                                    @error('duration')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="features" class="form-label">Features</label>
                                    <div id="featureWrapper">
                                        @foreach(explode(',', $packages->features) as $feature)
                                            <div class="input-group mb-2 feature-input">
                                                <input type="text" class="form-control" name="features[]" value="{{ $feature }}" placeholder="Enter feature">
                                                <button type="button" class="btn btn-danger removeFeatureBtn">Remove</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary" id="addFeatureBtn">Add More</button>
                                    @error('features')
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
    <script>
        document.getElementById('addFeatureBtn').addEventListener('click', function () {
            var featureWrapper = document.getElementById('featureWrapper');
            var newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-2', 'feature-input');

            newInputGroup.innerHTML = `
        <input type="text" class="form-control" name="features[]" placeholder="Enter feature">
        <button type="button" class="btn btn-danger removeFeatureBtn">Remove</button>
    `;

            featureWrapper.appendChild(newInputGroup);

            // Add event listener to remove the input group
            newInputGroup.querySelector('.removeFeatureBtn').addEventListener('click', function () {
                newInputGroup.remove();
            });
        });

        // Add this event listener to existing remove buttons
        document.querySelectorAll('.removeFeatureBtn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                btn.closest('.feature-input').remove();
            });
        });


    </script>
    <!--end page wrapper -->
@endsection
