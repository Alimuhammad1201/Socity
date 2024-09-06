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
        .summary {
            margin-bottom: 20px;
        }
        .summary .box {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
            height: 120px; /* Adjust the height as needed */
            box-sizing: border-box;
        }
        .summary h5 {
            margin-bottom: 5px;
        }
        .summary .amount {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        .summary .description {
            font-size: 14px;
            color: #777;
        }
        .table th {
            background-color: rgba(75, 192, 192, 0.8);
            color: white;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        .chart-container {
            margin-top: 40px;
        }
        @media (max-width: 768px) {
            .invoice-title {
                font-size: 24px;
            }
            .company-details {
                text-align: left;
                margin-top: 20px;
            }
            .summary .box {
                padding: 10px;
            }
            .summary .amount {
                font-size: 18px;
            }
        }
        @media (max-width: 576px) {
            .invoice-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .company-details {
                text-align: center;
                margin-top: 10px;
            }
            .summary .box {
                padding: 8px;
            }
            .summary .amount {
                font-size: 16px;
            }
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
                <strong>Block:</strong> {{ $additionalinvoiceMaster->Block_name }}<br>
                <strong>Flat No:</strong> {{ $additionalinvoiceMaster->flat_no }}<br>
                <strong>Owner </strong> {{ $additionalinvoiceMaster->owner_name }}<br>
            </div>
        </div>

        <div class="summary">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="box">
                        <h4>Total Bill</h4>
                        <p class="amount">Rs 5000</p>
                        <p class="description">For the month of September</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="box">
                        <h5>Due Date</h5>
                        <p class="amount">12-4-2020</p>
                        <p class="description">For the month of september</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="box">
                        <h4 style="font-size: 15px">Payment After Due Date</h4>
                        <p class="amount">Rs 10000</p>
                        <p class="description">As of 15/08/2024</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="box">
                        <h5 style="font-size: 18px;">Per Flat Maintenace</h5>
                        <p class="amount">Rs 200</p>
                        <p class="description">As of 15/08/2024</p>
                    </div>
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
