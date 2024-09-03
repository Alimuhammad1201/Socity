<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            background: #e9ecef;
        }

        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background-color:#171616;
            color: #fff;
        }

        .logo img {
            max-width: 120px;
            height: auto;
        }

        .avatar {
            width: 6rem;
            height: 6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
            background-color: #f0f0f0;
            border: 4px solid #fff;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
            padding: 2rem;
        }

        .card-body h5 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-body .text-muted {
            font-size: 0.875rem;
        }

        .border-success {
            border-color: #28a745 !important;
        }

        .list-group-item {
            border: none;
            padding: 1rem;
        }

        .list-group-item span {
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 0.875rem;
            border-radius: 20px;
            padding: 0.5rem 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 mb-4">
            <!-- Card -->
            <div class="card">
                <div class="logo">
                    <img src="/assets/logo.png" alt="Logo">
                    <div class="avatar">
                        <img src="{{ asset('uploads/registration/profile/' . $registration->profile) }}" class="avatar-img" alt="Avatar">
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <h5 class="mb-0">{{$registration->name}}</h5>
                    <span class="text-muted d-block mb-3">{{$registration->type}}</span>
                    <div class="row mx-0 border-top border-bottom">
                        <div class="col-6 text-center border-end py-3">
                            <h5 class="mb-0">{{$registration->flat_no}}</h5>
                            <small class="text-muted">Flat No</small>
                        </div>
                        <div class="col-6 text-center py-3">
                            <h5 class="mb-0">{{$registration->block}}</h5>
                            <small class="text-muted">Block</small>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex align-items-center justify-content-between">
                        <span class="text-muted small">CNIC NO </span>
                        <strong>{{$registration->nic_no}}</strong>
                    </li>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <span class="text-muted small">Contact</span>
                            <strong>{{$registration->contact_no}}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <span class="text-muted small">Location</span>
                            <strong>{{$registration->location}}</strong>
                        </li>

                       
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
