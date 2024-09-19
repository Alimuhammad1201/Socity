
    $(document).ready(function() {
        $('#block').change(function() {
            var blockId = $(this).val();
            if (blockId) {
                $.ajax({
                    url: '/get-flats/' + blockId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#flat_no').empty();
                        $('#flat_no').append('<option value="" selected>Select Flat No</option>');
                        $.each(data, function(Key, value) {
                            $('#flat_no').append('<option value="' + value.id + '">' + value.flat_no + '</option>');
                        });
                    }
                });
            } else {
                $('#flat_no').empty();
                $('#flat_no').append('<option value="" selected>Select Flat No</option>');
            }

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
                            $('#assgiend_user').val(data.ownerName);
                            // $('#contact').val(data.contact);
                        } else {
                            $('#assgiend_user').val('');
                            // $('#contact').val('');
                            Swal.fire({
                                icon: 'error',
                                title: 'Owner not found',
                                text: 'No owner found for the selected flat.',
                            });
                        }
                    }
                });
            } else {
                $('#assgiend_user').val('');
                // $('#contact').val('');
            }
        });
    }); 
