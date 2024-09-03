<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Get Flat
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

    // delete

    $(document).ready(function() {
    $('.delete-btn').on('click', function(event) {
        event.preventDefault();

        var $this = $(this);
        var id = $this.data('id');
        var url = '{{ route('allot.delete', ':id') }}'.replace(':id', id);


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

document.addEventListener('DOMContentLoaded', function() {
    const totalAmountField = document.getElementById('totalAmount');
    const amountAfterDueDateField = document.getElementById('amount_after_due_date');
    const subtotalField = document.getElementById('subtotal');
    
    function formatCurrency(value) {
        // Convert number to the format "65,00.00"
        return value.toLocaleString('de-DE', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).replace('.', ',').replace(/(\d+),(\d{2})$/, '$1.$2');
    }

    function updateTotals() {
        let totalAmount = 0;

        // Re-fetch amount inputs every time
        const amountInputs = document.querySelectorAll('input[name="amount[]"]');

        amountInputs.forEach(input => {
            const value = parseFloat(input.value.replace(',', '.')) || 0;
            totalAmount += value;
        });

        // Update total amount field
        totalAmountField.value = formatCurrency(totalAmount);

        // Get amount after due date
        const amountAfterDueDate = parseFloat(amountAfterDueDateField.value.replace(',', '.')) || 0;

        // Calculate subtotal
        const subtotal = totalAmount + amountAfterDueDate;

        // Update subtotal field
        subtotalField.value = formatCurrency(subtotal);
    }

    // Add event listener for amount fields
    document.getElementById('productTable').addEventListener('input', function(event) {
        if (event.target.name === 'amount[]' || event.target.id === 'amount_after_due_date') {
            updateTotals();
        }
    });

    // Bind event directly to Amount After Due Date field
    amountAfterDueDateField.addEventListener('input', function() {
        updateTotals();
    });

    // Initial calculation
    updateTotals();
});


function addRow() {
    var table = document.getElementById('productTable');
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    
    var cell1 = row.insertCell(0);
    cell1.innerHTML = rowCount + 1;

    var cell2 = row.insertCell(1);
    cell2.innerHTML = `<select class="form-control" name="Invoice_type[]">
                            <option>Select Invoice Type</option>
                            @foreach ($inv_type as $row)
                                <option value="{{ $row->id }}">{{ $row->type_name }}</option>
                            @endforeach
                        </select>`;

    var cell3 = row.insertCell(2);
    cell3.innerHTML = '<input type="text" class="form-control amount" name="amount[]" oninput="updateTotals()">';

    var cell4 = row.insertCell(3);
    cell4.innerHTML = '<button type="button" class="btn btn-success" onclick="addRow()">+</button>';

    var cell5 = row.insertCell(4);
    cell5.innerHTML = '<button type="button" class="btn btn-danger" onclick="removeRow(this)">-</button>';
    
    // Recalculate totals whenever a new row is added
    updateTotals();
}

function removeRow(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);

    // Update row numbers
    var table = document.getElementById('productTable');
    for (var i = 0; i < table.rows.length; i++) {
        table.rows[i].cells[0].innerHTML = i + 1;
    }

    // Recalculate totals
    updateTotals();
}


</script>