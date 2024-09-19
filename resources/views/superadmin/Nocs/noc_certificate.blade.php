{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOC Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 20px;
        }

        .certificate-container {
            width: 80%;
            margin: 0 auto;
            background: white;
            border: 5px solid #000;
            padding: 20px;
            text-align: center;
        }

        h1 {
            text-transform: uppercase;
            font-size: 40px;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .noc-details {
            text-align: left;
            margin-top: 20px;
            line-height: 2;
        }

        .noc-details p {
            font-size: 18px;
            margin: 0;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 16px;
        }

        @media print {
            .certificate-container {
                border: none;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="certificate-container">
    <h1>No Objection Certificate (NOC)</h1>
    <p>This is to certify that:</p>
    
    <div class="noc-details">
        <p><strong>Name:</strong> {{ $nocData->name }}</p>
        <p><strong>Flat No:</strong> {{ $nocData->flatArea->flat_no }}</p>
        <p><strong>Block:</strong> {{ $nocData->block->Block_name }}</p>
        <p><strong>NOC Number:</strong> {{ $nocData->noc_number }}</p>
        <p><strong>Issue Date:</strong> {{ $nocData->issue_date }}</p>
        <p><strong>Valid Until:</strong> {{ $nocData->valid_until }}</p>
        <p><strong>Purpose:</strong> {{ $nocData->purpose }}</p>
    </div>

    <div class="footer">
        <p>Authorized Signature</p>
        <p>Date: {{ now()->format('d-m-Y') }}</p>
    </div>
</div>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NOC Certificate</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
    }
    .certificate-container {
      border: 15px solid #007b8f;
      padding: 40px;
      margin: 50px auto;
      max-width: 900px;
      background-color: #ffffff;
      text-align: center;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .certificate-header {
      font-size: 24px;
      font-weight: bold;
    }
    .certificate-title {
      font-size: 40px;
      font-weight: bold;
      color: #007b8f;
    }
    .recipient-name {
      font-size: 36px;
      font-weight: bold;
      margin-top: 30px;
    }
    .certificate-body {
      font-size: 18px;
      margin-top: 30px;
    }
    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 50px;
    }
    .signature-block {
      text-align: center;
    }
    .signature-name {
      font-size: 18px;
      font-weight: bold;
    }
    .signature-title {
      font-size: 14px;
      color: #666;
    }
    .certificate-footer {
      margin-top: 20px;
      font-size: 16px;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="certificate-container">
    <!-- Company logo and title side-by-side -->
    <div class="row mb-4">
      <div class="col-6 text-left">
        <img src="/assets/images/logo.png" alt="Company Logo" width="200px">
      </div>
      <div class="col-6 text-right">
        <div class="certificate-header">
          YOUR COMPANY <br>
          <small>Your tagline here</small>
        </div>
      </div>
    </div>

    <div class="certificate-title">No Objection Certificate (NOC)</div>

    <p class="certificate-body">This certificate is proudly presented to</p>

    <div class="recipient-name">{{ $nocData->name }}</div>

    <p class="certificate-body">
        {{ $nocData->purpose }}
    </p>

    <div class="signatures">
      <div class="signature-block">
          <div class="signature-title">------------------------------------</div>
        <div class="signature-name">Admin Signature</div>
      </div>
      
    </div>

    <div class="certificate-footer">
      CERTIFICATE NO: {{ $nocData->noc_number }} | ISSUING DATE: {{ Carbon\Carbon::parse($nocData->issue_date)->format('d-m-Y') }}
    </div>
  </div>
</body>
</html>
