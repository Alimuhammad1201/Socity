<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
        $('#block').change(function() {
            var blockId = $(this).val();
            if(blockId) {
                $.ajax({
                    url: '/get-flats/'+blockId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#flat_no').empty();
                        $('#flat_no').append('<option value="" selected>Select Flat No</option>');
                        $.each(data, function(key, value) {
                            $('#flat_no').append('<option value="'+ value.id +'">'+ value.flat_no +'</option>');
                        });
                    }
                });
            } else {
                $('#flat_no').empty();
                $('#flat_no').append('<option value="" selected>Select Flat No</option>');
            }
        });
    });

    $('#flat_no').change(function() {
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

    $(document).ready(function() {
    $('.delete-btn').on('click', function(event) {
        event.preventDefault();

        var $this = $(this);
        var id = $this.data('id');
        var url = '{{ route('nocs.delete', ':id') }}'.replace(':id', id);


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

   

</script>