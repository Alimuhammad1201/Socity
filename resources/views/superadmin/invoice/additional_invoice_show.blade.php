<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            background: #fff;
        }
        .invoice-header {
            padding: 10px 0;
            border-bottom: 2px solid #ddd;
            margin-bottom: 20px;
        }
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #4CAF50;
        }
        .company-details {
            text-align: right;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
        }
        .card-body {
            padding: 20px;
        }
        .summary {
            margin-bottom: 20px;
        }
        .table th {
            background-color: #4CAF50;
            color: white;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="row invoice-header">
            <div class="col-md-6 d-flex align-items-center">
                <img src="/uploads/logo.png" alt="Logo" style="height: 100px; margin-right: 10px;"><br>
                <h2 class="invoice-title">THE COURT HEIGHT</h2>
            </div>
            
            <div class="col-md-6 company-details">
                <strong>Invoice No:</strong> {{ $additionalinvoiceMaster->invoice_no }}<br>
                <strong>Due Date:</strong> {{ $additionalinvoiceMaster->due_date->format('d-m-Y') }}<br>
                <strong>Block:</strong> {{ $additionalinvoiceMaster->Block_name }}<br>
                <strong>Flat No:</strong> {{ $additionalinvoiceMaster->flat_no }}<br>
            </div>
        </div>

        <div class="summary">
            <div class="row">
                <div class="col-md-6">
                    <h5>Owner: {{ $additionalinvoiceMaster->owner_name }}</h5>
                    <h5>Contact: {{ $additionalinvoiceMaster->contact_no }}</h5>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Description:</strong> {{ $additionalinvoiceMaster->description }}</p>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Invoice Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($additionalinvoiceDetails as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->type_name }}</td>
                    <td>{{ number_format($detail->amount, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-light">
                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                    <td>{{ number_format($additionalinvoiceDetails->sum('amount'), 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p><strong>Thank you for your business!</strong></p>
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
        </div>
    </div>
</body>
</html>
