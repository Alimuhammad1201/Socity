<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Packages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Choose Your Package</h2>
    <div class="row">
            @csrf
            @foreach ($packages as $package)
                <div class="package">
                    <h3>{{ $package->package_name }}</h3>
                    <p>{{ $package->description }}</p>
                    <p>Price: ${{ $package->price }}</p>
                    <a href="{{ route('subscribe', $package->id) }}">Subscribe</a>
                </div>
            @endforeach
    </div>
</div>
</body>
</html>
