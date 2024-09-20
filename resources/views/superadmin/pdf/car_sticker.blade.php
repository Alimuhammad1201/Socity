<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Card Design</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
        }

        .card {
            background-color: #000;
            width: 100%;
            height: auto;
            border: 1px solid #333;
            display: flex;
            padding: 20px;
            color: white;
        }

        .info {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info h1 {
            font-size: 36px;
            font-weight: bold;
        }

        .info h2 {
            font-size: 24px;
            color: #e50000;
            margin: 10px 0;
        }

        .info p {
            font-size: 18px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .qr-code {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .qr-code img {
            width: 200px;
            height: 200px;
        }

        .qr-code p {
            font-size: 18px;
            color: #e50000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="info">
        <h1>Theodore Lewitz</h1>
        <h2>Head Mechanic</h2>
        <div class="sticker-info">
            <p><strong>Owner Name:</strong> {{ $carSticker->allotment_id }}</p>
            <p><strong>Car Number:</strong> {{ $carSticker->car_number }}</p>
            <p><strong>Card ID:</strong> {{ $carSticker->sticker_id }}</p>
        </div>
    </div>
{{--    <div class="qr-code">--}}
{{--        <img src="{!! $qrCode !!}">--}}
{{--        <p>Scan to see our services</p>--}}
{{--    </div>--}}
</div>
</body>
</html>
