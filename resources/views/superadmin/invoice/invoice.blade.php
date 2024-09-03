<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
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
                <strong>Invoice No:</strong> {{ $invoice->Invoicenumber }}<br>
                <strong>Date:</strong> {{ $invoice->date }}<br>
                <strong>Month:</strong> {{ \Carbon\Carbon::parse($invoice->date)->format('F') }}<br>
            </div>
        </div>

        <div class="summary">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="box">
                        <h4>Total Bill</h4>
                        <p class="amount">Rs {{ $invoice->total }}</p>
                        <p class="description">For the month of {{ \Carbon\Carbon::parse($invoice->date)->format('F') }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="box">
                        <h5>Due Date</h5>
                        <p class="amount">{{ \Carbon\Carbon::parse($invoice->date)->format('d-m-Y') }}</p>
                        <p class="description">For the month of aug</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="box">
                        <h4 style="font-size: 15px">Payment After Due Date</h4>
                        <p class="amount">Rs {{$invoice->after_due_date_amount}}</p>
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
        <hr>
        <hr>
<div class="row">
        <div class="col-md-6">
            <div class="mt-5">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>

        
        <div class="col-md-6">
            <table class="table table-bordered mt-5 mb-5">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Month</th>
                        <th>Bill</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach($chart as $key => $detail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ Carbon\Carbon::parse($detail->created_at)->format('F') }}</td>
                        <td>{{ $detail->total }}</td>
                    </tr>
                    @endforeach
                    {{-- <tr>
                        <td colspan="2" class="text-right"><strong>Total:</strong></td>
                        <td><strong>{{ $invoice->total }}</strong></td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
</div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Invoice Type</th>
                    <th>Amount (PKR)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                @endphp
                @foreach($invoiceDetails as $key => $detail)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $detail->type_name }}</td>
                    <td>{{ $detail->amount }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                    <td><strong>{{ $invoice->total }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p><strong>Thank you for your business!</strong></p>
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
        </div>
    </div>
  <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Your JavaScript for generating chart -->
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // You can change to 'line', 'pie', etc.
            data: {
                labels: [
                    @foreach($chart as $detail)
                       '{{ Carbon\Carbon::parse($detail->created_at)->format('F') }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Amount in PKR',
                    data: [
                        @foreach($chart as $detail)
                            {{ $detail->total }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
