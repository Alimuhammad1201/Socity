<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
  

    document.addEventListener('DOMContentLoaded', function() {
        const totalAmountField = document.getElementById('totalAmount');
        const amountAfterDueDateField = document.getElementById('amount_after_due_date');
        const subtotalField = document.getElementById('subtotal');
        
        function formatCurrency(value) {
            return value.toLocaleString('de-DE', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).replace('.', ',').replace(/(\d+),(\d{2})$/, '$1.$2');
        }

        function updateTotals() {
            let totalAmount = 0;

            const amountInputs = document.querySelectorAll('input[name="amount[]"]');

            amountInputs.forEach(input => {
                const value = parseFloat(input.value.replace(',', '.')) || 0;
                totalAmount += value;
            });

            totalAmountField.value = formatCurrency(totalAmount);

            const amountAfterDueDate = parseFloat(amountAfterDueDateField.value.replace(',', '.')) || 0;
            const subtotal = totalAmount + amountAfterDueDate;

            subtotalField.value = formatCurrency(subtotal);
        }

        document.getElementById('productTable').addEventListener('input', function(event) {
            if (event.target.name === 'amount[]' || event.target.id === 'amount_after_due_date') {
                updateTotals();
            }
        });

        amountAfterDueDateField.addEventListener('input', function() {
            updateTotals();
        });

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
        
        updateTotals();
    }

    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);

        var table = document.getElementById('productTable');
        for (var i = 0; i < table.rows.length; i++) {
            table.rows[i].cells[0].innerHTML = i + 1;
        }

        updateTotals();
    }


