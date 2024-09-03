{{--<form id="dynamic-form-container" action="{{route('invoice.store')}}" method="POST">--}}
<form id="dynamic-form-container" action="{{ route('type.create') }}" method="POST">
@csrf
    <div class="form-container" id="form-template">
        <div class="row g-3">
            <div class="col-md-12">
                <label for="type" class="form-label">Add Invoice Type</label>
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="Type" name="inv_type" placeholder="Type">
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Container for dynamic fields -->
    <div id="rent-fields-container"></div>

    <!-- Ensure Register button is outside of the form-container -->
    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-light px-5" style="width: 100%">Add Type</button>
    </div>
</form>
