<div class="row">
    <div class="col-xl-12 mx-auto">

        <div class="card border-top border-white">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-category me-1 font-22 text-white"></i></div>
                    <h5 class="mb-0 text-white">{{_('Add Additional Invoice')}}</h5>
                </div>
                <hr>
                <form id="dynamic-form-container" action="{{ route('addi_invoice.store') }}" method="POST">
                    @csrf
                    <div class="form-container" id="form-template">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="invoicenumber" class="form-label">Invoice No</label>
                                <input type="text" value="{{ session('invoice_number')}}" class="form-control" id="invoicenumber" name="Invoicenumber" placeholder="Invoice Number" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="block" class="form-label">Block</label>
                                <select class="form-control" id="block" name="block">
                                    <option value="" selected>Select Block</option>
                                    @foreach($block as $row)
                                       <option value="{{$row->id}}">{{$row->Block_name}}</option>
                                    @endforeach
                                </select>
                                @error('block')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="flat_no" class="form-label">Flat No</label>
                                <select class="form-control" id="flat_no" name="flat_no">
                                    <option value="" selected>Select Flat No</option>
                                </select>
                                @error('flat_no')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="form-label">Owner Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Owner Name" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Owner Contact Number</label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="Owner Contact Number" readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Billing Due Date">
                            </div>

                            <div class="col-md-12">
                                <label for="date" class="form-label">Description</label>
                                <textarea style="text: white;" type="text" rows="1" class="form-control" id="description" name="description" placeholder="Description"></textarea>
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
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <select type="text" class="form-control" name="Invoice_type[]">
                                            <option>Select Invoice Type</option>
                                            @foreach ($inv_type as $row)
                                                <option value="{{$row->id}}">{{$row->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control amount-field" name="amount[]" oninput="calculateTotal()"></td>
                                    <td><button type="button" class="btn btn-success" onclick="addRow()">+</button></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">-</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 text-start">
                            <label for="totalAmount" class="form-label">Total Amount:</label>
                        </div>
                        <div class="col-md-3 ms-auto">
                            <input type="text" class="form-control" name="total" id="totalAmount" readonly>
                        </div>
                    </div>
                    
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-light px-5">Ganrate Invoice</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
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

    function calculateTotal() {
    let total = 0;
    const amounts = document.querySelectorAll('.amount-field');
    amounts.forEach(function(amount) {
        const value = parseFloat(amount.value);
        if (!isNaN(value)) {
            total += value;
        }
    });
    document.getElementById('totalAmount').value = total.toFixed(2);
}

function addRow() {
    const table = document.getElementById('productTable');
    const rowCount = table.rows.length;
    const row = table.insertRow(rowCount);

    row.innerHTML = `
        <td>${rowCount + 1}</td>
        <td>
            <select type="text" class="form-control" name="Invoice_type[]">
                <option>Select Invoice Type</option>
                @foreach ($inv_type as $row)
                    <option value="{{$row->id}}">{{$row->type_name}}</option>
                @endforeach
            </select>
        </td>
        <td><input type="text" class="form-control amount-field" name="amount[]" oninput="calculateTotal()"></td>
        <td><button type="button" class="btn btn-success" onclick="addRow()">+</button></td>
        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">-</button></td>
    `;

    calculateTotal(); // Recalculate total after adding a row
}

function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
    calculateTotal(); // Recalculate total after removing a row
}
</script>
