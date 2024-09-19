<div class="row">
    <div class="col-xl-12 mx-auto">
        <div class="card border-top border-white">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-category me-1 font-22 text-white"></i></div>
                    <h5 class="mb-0 text-white">{{ _('Edit Invoice') }}</h5>
                </div>
                <hr>
                <form id="dynamic-form-container" action="{{ route('invoice.update', $invoice_edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-container" id="form-template">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="invoicenumber" class="form-label">Invoice No</label>
                                <input type="text" class="form-control" id="invoicenumber" name="Invoicenumber" value="{{$invoice_edit->Invoicenumber}}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Billing Due Date" value="{{$invoice_edit->date}}">
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description"  rows="1">{{$invoice_edit->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4" id="rent-fields-container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Invoice Type</th>
                                    <th>Amount</th>
                                    <th>Add</th>
                                    <th>Del.</th>
                                </tr>
                            </thead>
                            <tbody id="productTable">
                                @foreach ($invoice_detail as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <select class="form-control" name="Invoice_type[]">
                                            <option>Select Invoice Type</option>
                                            @foreach ($inv_type as $type)
                                                <option value="{{ $type->id }}" {{ $row->Invoice_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control amount" value="{{ $row->amount }}" name="amount[]" oninput="updateTotals()">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success" onclick="addRow()">+</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">-</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="text-end"><strong>Total:</strong></div>
                            <div>
                                <input type="text" class="form-control" id="totalAmount" name="totalAmount" value="{{$invoice_edit->total_amount}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="text-end"><strong>Amount After Due Date:</strong></div>
                            <div>
                                <input type="text" class="form-control" id="amount_after_due_date" name="amount_after_due_date" value="{{$invoice_edit->after_due_date_amount}}" oninput="updateTotals()" placeholder="Enter amount">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-between">
                            <div class="text-end"><strong>Sub Total:</strong></div>
                            <div>
                                <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-light px-5">Generate Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
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
                                @foreach ($inv_type as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
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
</script>
