<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // delete   ,
    document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const complaintId = this.getAttribute('data-id');
            const complaintStatus = this.getAttribute('data-status'); // Assuming this attribute exists
            const adminRemark = this.getAttribute('data-admin_remark'); // Assuming this attribute exists

            // Set values in the modal
            document.getElementById('edit-complaint-id').value = complaintId;
            document.getElementById('edit-complaint-status').value = complaintStatus;
            document.getElementById('edit-admin-remark').value = adminRemark;
        });
    });
});

    $(document).ready(function() {
    $('.delete-btn').on('click', function(event) {
        event.preventDefault();

        var $this = $(this);
        var id = $this.data('id');
        var url = '{{ route('flat.delete', ':id') }}'.replace(':id', id);


        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this item!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        Swal.fire(
                            'Deleted!',
                            'Your item has been deleted.',
                            'success'
                        );


                        $this.closest('tr').fadeOut(400, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the item.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});

// Get Flat
    $(document).ready(function() {
        // When the block is changed, load the flats
        $('#block').change(function() {
            var blockId = $(this).val();
            if (blockId) {
                $.ajax({
                    url: '/get-flats/' + blockId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Clear previous flat options
                        $('#flat_no').empty();
                        $('#flat_no').append('<option value="" selected>Select Flat No</option>');

                        // Populate the flats dropdown with the relevant flats
                        $.each(data, function(key, value) {
                            $('#flat_no').append('<option value="' + value.id + '">' + value.flat_no + '</option>');
                        });
                    }
                });
            } else {
                $('#flat_no').empty();
                $('#flat_no').append('<option value="" selected>Select Flat No</option>');
            }
        });
    });




    // Flat dropdown change to get owner details
        $(document).ready(function() {
        $('#block').change(function() {
            var flatId = $(this).val();
            if (flatId) {
                $.ajax({
                    url: '/get-owner/' + flatId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.ownerName) {
                            $('#name').val(data.ownerName);
                            $('#contact').val(data.contact);
                        } else {
                            $('#name').val('');
                            $('#contact').val('');
                            Swal.fire({
                                icon: 'error',
                                title: 'Owner not found',
                                text: 'No owner found for the selected flat.',
                            });
                        }
                    }
                });
            } else {
                $('#name').val('');
                $('#contact').val('');
            }
        });
    });

 </script>
