<form id="dynamic-form-container" action="{{route('block.store')}}" method="POST">
    @csrf
    <div class="form-container" id="form-template">
        <div class="row g-3">
            <div class="col-md-12">
                <label for="block" class="form-label">{{_('Add Block')}}</label>
                <input type="text" class="form-control @error('block') is-invalid @enderror" id="block" name="block" placeholder="Block Name">
                @error('block')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Container for dynamic fields -->
    <div id="rent-fields-container"></div>

    <!-- Ensure Register button is outside of the form-container -->
    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-light px-5" style="width: 100%">Add Block</button>
    </div>
</form>
