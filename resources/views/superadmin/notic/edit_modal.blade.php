<!-- Edit Modal -->
<div class="modal fade" id="editComplaintModal" tabindex="-1" aria-labelledby="editComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editComplaintModalLabel">Edit Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="{{ route('notic.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Assuming you use PUT for update -->
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group mb-3">
                        <label for="editTitle">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editImage">Image</label>
                        <input type="file" class="form-control" id="editImage" name="image">
                    </div>
                    <!-- You can show the existing image if needed -->
                    <div class="form-group">
                        <img id="existingImage" src="" alt="Current Image" style="width: 120px; height: 180px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
