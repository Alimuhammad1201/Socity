<div class="modal fade" id="editComplaintModal" tabindex="-1" aria-labelledby="editComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(0 0 0 / 70%);">
            <div class="modal-header">
                <h5 class="modal-title" id="editComplaintModalLabel">Edit Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-complaint-form" method="POST" action="{{ route('complaints.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-complaint-id" name="id">

                    <div class="mb-3">
                        <label for="edit-complaint-status" class="form-label">Status</label>
                        <select class="form-control" id="edit-complaint-status" name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Resolved">Resolved</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-admin-remark" class="form-label">Admin Remarks</label>
                        <input type="text" class="form-control" id="edit-admin-remarks" name="admin_remark" required>
                    </div>

                    <div class="mb-3">
                        <label for="after_img" class="form-label">After Image</label>
                        <input type="file" class="form-control" id="after_img" name="after_img">
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
