<div class="modal fade" id="editBlockModal" tabindex="-1" aria-labelledby="editBlockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(0 0 0 / 70%);">
            <div class="modal-header">
                <h5 class="modal-title" id="editBlockModalLabel">Edit Flat Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-block-form" method="POST" action="{{ route('block.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-block-id" name="id">

                    <div class="mb-3">
                        <label for="edit-flat-no" class="form-label">Flat No</label>
                        <input type="text" class="form-control" id="edit-flat-no" name="flat_no" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-block-name" class="form-label">Block Name</label>
                        <input type="text" class="form-control" id="edit-block-name" name="block_name" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
