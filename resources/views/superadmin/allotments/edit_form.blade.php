<div class="row">
    <div class="col-xl-9 mx-auto">

        <div class="card border-top border-white">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-category me-1 font-22 text-white"></i></div>
                    <h5 class="mb-0 text-white">Edit Allotments</h5>
                </div>
                <hr>
                <form id="dynamic-form-container" action="" method="POST">
                    @csrf
                    <div class="form-container" id="form-template">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="selectFlat" class="form-label">Flat Number</label>
                                <select class="form-control" id="selectFlat">
                                    <option value="" selected>Select Flat No</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="selectBlock" class="form-label">Add Allotments Block</label>
                                <select class="form-control" id="selectBlock">
                                    <option value="" selected>Select Block</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="ownerName" class="form-label">Owner Name</label>
                                <input type="text" class="form-control" id="ownerName" placeholder="Owner Name">
                            </div>
                            <div class="col-md-6">
                                <label for="ownerContact" class="form-label">Owner Contact Number</label>
                                <input type="text" class="form-control" id="ownerContact" placeholder="Owner Contact Number">
                            </div>
                            <div class="col-md-6">
                                <label for="altOwnerContact" class="form-label">Alternate Owner Contact Number</label>
                                <input type="text" class="form-control" id="altOwnerContact" placeholder="Alternate Owner Contact Number">
                            </div>
                            <div class="col-md-6">
                                <label for="ownerEmail" class="form-label">Owner Email</label>
                                <input type="email" class="form-control" id="ownerEmail" placeholder="Owner Email">
                            </div>
                            <div class="col-md-6">
                                <label for="memberContact" class="form-label">Owner Member Contact</label>
                                <input type="text" class="form-control" id="memberContact" placeholder="Owner Member Contact">
                            </div>

                            <div class="col-md-6 mt-5">
                                <a class="btn btn-primary" id="add-more">Flat On Rent</a>
                            </div>
                        </div>
                    </div>

                    <!-- Container for dynamic fields -->
                    <div class="mt-4" id="rent-fields-container"></div>

                    <!-- Ensure Register button is outside of the form-container -->
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-light px-5">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>